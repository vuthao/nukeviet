---
name: nvsx-verify
description: Xác minh triển khai khớp với artifact của change. Dùng khi người dùng muốn kiểm tra triển khai đã hoàn chỉnh, chính xác, và nhất quán trước khi lưu trữ.
---

Bạn đang sử dụng skill nvsx-verify, được mô tả như sau:

Xác minh rằng một triển khai khớp với các artifact của change (specs, tasks, design).

> **GHI CHÚ CLI**: Chạy tất cả lệnh `openspec` và `bash` trực tiếp từ thư mục gốc của workspace. KHÔNG `cd` vào bất kỳ thư mục nào trước khi chạy. CLI `openspec` được thiết kế để hoạt động từ thư mục gốc dự án.

> **CÀI ĐẶT**: Nếu `openspec` chưa được cài, chạy `npm i -g @fission-ai/openspec@latest`. Nếu cần chạy `openspec init`, luôn dùng `openspec init --tools none`.

**DANH SÁCH ĐEN SUBAGENT:** KHÔNG BAO GIỜ dùng subagent `explore` hoặc `plan`. Đây là các subagent chung từ các kit khác và KHÔNG thuộc workflow này. Chỉ dùng các subagent verifier được liệt kê trong lệnh này.

**Tại sao dùng subagent?** Việc xác minh chạy trong context sạch, tránh thiên kiến từ cuộc hội thoại triển khai. Điều này đảm bảo đánh giá độc lập, không thiên vị.

**Input**: Tùy chọn chỉ định tên change. Nếu bỏ qua, kiểm tra xem có thể suy ra từ context hội thoại không. Nếu mơ hồ hoặc không rõ ràng, BẮT BUỘC phải hỏi về các change hiện có.

## Ngữ cảnh NukeViet

Khi xác minh triển khai trong dự án NukeViet, áp dụng thêm các kiểm tra sau:

**Checklist bảo mật NukeViet:**
- [ ] CSRF token: form POST phải có `$nv_Token` và kiểm tra `nv_check_token()`
- [ ] XSS: output HTML phải qua `nv_htmlspecialchars()` hoặc Smarty auto-escape
- [ ] SQLi: truy vấn động phải dùng `prepare()` + `bindParam()` / `bindValue()`, không nối chuỗi trực tiếp
- [ ] Guard constants: mỗi file PHP phải có `defined('NV_MAINFILE') or die(...)` ở đầu
- [ ] Phân quyền: kiểm tra `$admin_info['admin_id']` hoặc `$user_info['userid']` trước khi thực hiện thao tác nhạy cảm

**Tham chiếu skill:**
- `nukeviet-security` — Quy tắc bảo mật đầy đủ: SQLi, CSRF, XSS, filter `$nv_Request`
- `nukeviet-review` — Quy trình review code, convention, tiêu chuẩn báo cáo lỗi

**Kiểm tra cấu trúc file module/theme:**
- Module: phải có `module.json`, `funcs/`, `admin/`, `language/vi/`, `language/en/`
- Theme: phải có `theme.json`, `layout/`, `blocks/`, `scss/` (nếu có custom styles)
- Block: controller trong `blocks/<block_name>/`, template `.tpl` đúng vị trí
- Namespace PSR-4: `NukeViet\Module\<ModuleName>` cho module, kiểm tra `composer.json`

## Các bước thực hiện

1. **Nếu không có tên change, hỏi để chọn**

   Chạy `openspec list --json` để lấy danh sách change hiện có. Dùng **công cụ AskUserQuestion** để người dùng chọn.

   Hiển thị các change có tasks triển khai (artifact tasks tồn tại).
   Bao gồm schema được dùng cho mỗi change nếu có.
   Đánh dấu các change có tasks chưa hoàn thành là "(Đang thực hiện)".

   **QUAN TRỌNG**: KHÔNG đoán hoặc tự chọn change. Luôn để người dùng chọn.

2. **Kiểm tra status để hiểu schema**
   ```bash
   openspec status --change "<name>" --json
   ```
   Phân tích JSON để hiểu:
   - `schemaName`: Workflow đang dùng (ví dụ: "spec-driven")
   - Các artifact nào tồn tại cho change này

3. **Lấy thư mục change và tải artifacts**

   ```bash
   openspec instructions apply --change "<name>" --json
   ```

   Lệnh này trả về thư mục change và các file context. Đọc tất cả artifact có trong `contextFiles`.

   Cũng kiểm tra xem `openspec/changes/<name>/verify-fixes.md` có tồn tại không. Nếu có, đọc nó — file này chứa các vấn đề đã được sửa trước đó mà các verifier nên bỏ qua.

4. **Phát hiện loại change và chạy các verifier song song**

   Quét artifacts (proposal, specs, tasks) để phát hiện đặc điểm của change:
   - **Có UI**: từ khóa như component, page, screen, modal, form, button, layout, CSS, style, responsive, animation
   - **Có tests**: dự án có test framework (jest.config.*, vitest.config.*, pytest.ini, *.test.*, *.spec.*) VÀ change chạm vào code có thể test

   Chạy các verifier áp dụng được **song song**:

   | Verifier | Điều kiện |
   |----------|-----------|
   | `nvsx-verifier` | Luôn luôn |
   | `nvsx-arch-verifier` | Luôn luôn |
   | `nvsx-uiux-verifier` | Change có UI components |
   | `nvsx-test-verifier` | Dự án có test framework |

   Template hướng dẫn cho TẤT CẢ verifier:
   ```
   Xác minh triển khai cho change: <name>

   **Đường dẫn artifact:**
   - Tasks: openspec/changes/<name>/tasks.md
   - Proposal: openspec/changes/<name>/proposal.md
   - Design: openspec/changes/<name>/design.md (nếu tồn tại)
   - Specs: openspec/changes/<name>/specs/*.md (nếu tồn tại)

   **Các file đã sửa:** [danh sách từ triển khai]

   **Các vấn đề đã sửa trước đó (từ verify-fixes.md):**
   [nội dung của verify-fixes.md, hoặc "Không có" nếu file không tồn tại]
   ```

   Thêm context riêng cho từng verifier:
   - `nvsx-verifier`: bao gồm các điểm tập trung xác minh từ task annotations
   - `nvsx-uiux-verifier`: bao gồm các file chứa UI components
   - `nvsx-test-verifier`: bao gồm tên test framework và lệnh test
   - `nvsx-arch-verifier`: bao gồm ngôn ngữ/framework của dự án

5. **Gộp và trình bày báo cáo xác minh**

   Kết hợp báo cáo từ tất cả verifier thành một báo cáo thống nhất. KHÔNG sửa bất kỳ vấn đề nào — lệnh này chỉ báo cáo.

   ```
   ## Báo cáo Xác minh: <change-name>

   **Các verifier đã chạy:** nvsx-verifier, nvsx-arch-verifier [, nvsx-uiux-verifier] [, nvsx-test-verifier]

   ### Tóm tắt
   | Chiều | Nguồn | Trạng thái |
   |-------|-------|------------|
   | Tính đầy đủ | nvsx-verifier | ... |
   | Tính chính xác | nvsx-verifier | ... |
   | Tính nhất quán | nvsx-verifier | ... |
   | Kiến trúc | nvsx-arch-verifier | ... |
   | UI/UX | nvsx-uiux-verifier | ... (hoặc "bỏ qua — không có UI") |
   | Độ phủ Test | nvsx-test-verifier | ... (hoặc "bỏ qua — không có test framework") |

   ### Tất cả vấn đề (đã gộp, sắp xếp theo độ ưu tiên)
   **CRITICAL**: [tất cả critical từ tất cả verifier]
   **WARNING**: [tất cả warning từ tất cả verifier]
   **SUGGESTION**: [tất cả suggestion từ tất cả verifier]
   ```

   Loại bỏ trùng lặp các vấn đề chồng chéo (ví dụ: nếu cả nvsx-verifier và nvsx-arch-verifier đều gắn cờ cùng một file). Giữ cái cụ thể hơn.

6. **Đề xuất hành động tiếp theo dựa trên báo cáo**

   **Nếu có vấn đề CRITICAL:**
   ```
   X vấn đề critical được tìm thấy. Sửa trước khi lưu trữ.

   → Dùng `/nvsx-apply <name>` để tiếp tục triển khai và sửa vấn đề
   → Hoặc sửa thủ công và chạy lại `/nvsx-verify`
   ```

   **Nếu chỉ có warning/suggestion:**
   ```
   Không có vấn đề critical. Y warning cần xem xét.

   → Sẵn sàng lưu trữ: `/nvsx-archive <name>`
   → Hoặc sửa warning trước với `/nvsx-apply <name>`
   ```

   **Nếu tất cả đều ổn:**
   ```
   Tất cả kiểm tra đã qua. Sẵn sàng lưu trữ.

   → `/nvsx-archive <name>`
   ```

## Tham chiếu Subagent

| Subagent | Mục đích | Điều kiện |
|----------|----------|-----------|
| `nvsx-verifier` | Tính đầy đủ, chính xác, nhất quán so với artifacts | Luôn luôn |
| `nvsx-arch-verifier` | Kiến trúc, design patterns, SOLID, thay thế thư viện | Luôn luôn |
| `nvsx-uiux-verifier` | Accessibility, design tokens, responsive, trạng thái component, UI flows | Change có UI |
| `nvsx-test-verifier` | Sự tồn tại của test, độ phủ, chất lượng, edge cases | Dự án có test framework |

**Quy tắc ủy quyền:**
- Chạy tất cả verifier áp dụng được **song song** — chúng độc lập với nhau
- Cung cấp TẤT CẢ đường dẫn artifact từ contextFiles cho mỗi verifier
- Mỗi subagent không có lịch sử hội thoại — hãy rõ ràng về những gì cần xác minh
- Tất cả subagent chỉ trả về báo cáo — lệnh này KHÔNG sửa vấn đề
- Gộp báo cáo thành một output thống nhất, loại bỏ các vấn đề trùng lặp

## Output

Lệnh này chỉ xuất ra báo cáo xác minh. Nó KHÔNG:
- Sửa code
- Cập nhật tasks
- Chỉnh sửa bất kỳ file nào

Để sửa các vấn đề được tìm thấy trong báo cáo, dùng `/nvsx-apply <name>` — lệnh này sẽ tự động xác minh và tự động sửa.

Nội dung sau đây là yêu cầu của người dùng:
