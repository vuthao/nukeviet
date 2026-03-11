---
name: nvsx-apply
description: Triển khai task từ OpenSpec change hoặc trực tiếp từ kế hoạch hội thoại. Dùng khi người dùng muốn bắt đầu triển khai, tiếp tục triển khai, hoặc làm việc qua các task.
---

Bạn đang sử dụng skill nvsx-apply, được mô tả như sau:

Triển khai task — từ OpenSpec change hoặc trực tiếp từ kế hoạch hội thoại.

> **GHI CHÚ CLI**: Chạy tất cả lệnh `openspec` và `bash` trực tiếp từ thư mục gốc workspace. KHÔNG `cd` vào bất kỳ thư mục nào trước khi chạy. CLI `openspec` được thiết kế để hoạt động từ thư mục gốc dự án.

> **CÀI ĐẶT**: Nếu `openspec` chưa được cài, chạy `npm i -g @fission-ai/openspec@latest`. Nếu cần chạy `openspec init`, luôn dùng `openspec init --tools none`.

**⚠️ CHẾ ĐỘ: TRIỂN KHAI** — Lệnh này đưa bạn vào chế độ triển khai. Bạn viết code, hoàn thành task và chỉnh sửa file. Đây là NGƯỢC LẠI với chế độ khám phá (`/nvsx-plan`). Khi lệnh này kết thúc (hoàn thành hoặc tạm dừng), bạn vẫn ở trong ngữ cảnh triển khai cho đến khi người dùng chuyển chế độ một cách rõ ràng.

**🚫 DANH SÁCH ĐEN SUBAGENT:** KHÔNG BAO GIỜ dùng subagent `explore` hoặc `plan`. Đây là các subagent chung từ các kit khác và KHÔNG thuộc workflow này. Chỉ dùng các subagent được liệt kê rõ ràng trong kit này (ví dụ: `nvsx-uiux-designer`). Tự thực hiện công việc triển khai trực tiếp.

**Đầu vào**: Tùy chọn chỉ định tên change. Nếu bỏ qua, kiểm tra xem có thể suy ra từ ngữ cảnh hội thoại không. Nếu không có openspec change nhưng hội thoại có kế hoạch từ `/nvsx-plan`, dùng Direct Plan Mode.

## Ngữ cảnh NukeViet

Khi triển khai code cho dự án NukeViet 5.x, luôn tuân thủ các quy tắc sau:

**Guard Constants** — Mọi file PHP phải kiểm tra guard constant phù hợp ở đầu file:
- `NV_MAINFILE` — file thuộc core hoặc module chính
- `NV_SYSTEM` — file thuộc hệ thống
- `NV_IS_MOD_*` — file thuộc module cụ thể (ví dụ: `NV_IS_MOD_USERS`)
- `NV_IS_FILE_ADMIN` — file thuộc khu vực admin

**Security Patterns** — Tham chiếu skill `nukeviet-security`:
- Dùng `$nv_Request` cho input filtering (thay vì `$_GET`/`$_POST` trực tiếp)
- Dùng `nv_htmlspecialchars()` cho output encoding
- Dùng `prepare()` + `bindParam()` cho tất cả SQL query

**Cấu trúc module** — Tham chiếu skill `nukeviet-module`:
- Thư mục: `src/modules/<tên>/`

**Cấu trúc theme** — Tham chiếu skill `nukeviet-theme`:
- Thư mục: `src/themes/<tên>/`

**Database** — Tham chiếu skill `nukeviet-mysql`:
- Dùng `$db_slave` cho read query, `$db` cho write query
- Tuân thủ prefix đa ngôn ngữ chuẩn NukeViet 5

**Checklist khi triển khai code NukeViet:**
- Guard constants đầu file
- `$nv_Request` thay vì `$_GET`/`$_POST`
- `nv_htmlspecialchars()` cho output
- `prepare()` + `bindParam()` cho query

**Các bước**

1. **Xác định chế độ**

   Xác định chế độ nào sẽ dùng:

   **Chế độ A (OpenSpec Change)** — khi bất kỳ điều nào sau đây đúng:
   - Tên change được cung cấp
   - Ngữ cảnh hội thoại đề cập đến một change cụ thể
   - `openspec list --json` hiển thị các change đang hoạt động

   **Chế độ B (Direct Plan)** — khi TẤT CẢ các điều sau đây đúng:
   - Không có tên change và không có openspec change đang hoạt động (hoặc người dùng bỏ qua openspec)
   - Hội thoại có ngữ cảnh kế hoạch từ `/nvsx-plan` (đã thảo luận yêu cầu, quyết định, cách tiếp cận)

   **Kiểm tra độ phức tạp cho Chế độ B**: Nếu kế hoạch phức tạp (>10 task, kiến trúc đa thành phần, cần tài liệu thiết kế, mối quan tâm xuyên suốt), gợi ý: "Kế hoạch này khá lớn — bạn muốn tôi tạo một change có cấu trúc với `/nvsx-ff` để theo dõi tốt hơn, hay triển khai trực tiếp?" Để người dùng quyết định.

   Nếu không có chế độ nào áp dụng (không có change, không có ngữ cảnh kế hoạch) → hỏi người dùng muốn triển khai gì.

   **Nếu Chế độ A** → thông báo "Đang dùng change: <tên>" và tiến hành bước 2.
   **Nếu Chế độ B** → thông báo "Triển khai từ kế hoạch hội thoại" và chuyển đến **Direct Plan Mode** bên dưới.

2. **Kiểm tra trạng thái để hiểu schema**
   ```bash
   openspec status --change "<tên>" --json
   ```
   Phân tích JSON để hiểu:
   - `schemaName`: Workflow đang dùng (ví dụ: "spec-driven")
   - Artifact nào chứa các task (thường là "tasks" cho spec-driven, kiểm tra status cho các schema khác)

3. **Lấy hướng dẫn apply**

   ```bash
   openspec instructions apply --change "<tên>" --json
   ```

   Kết quả trả về:
   - Đường dẫn file ngữ cảnh (thay đổi theo schema — có thể là proposal/specs/design/tasks hoặc spec/tests/implementation/docs)
   - Tiến độ (tổng, hoàn thành, còn lại)
   - Danh sách task với trạng thái
   - Hướng dẫn động dựa trên trạng thái hiện tại

   **Xử lý các trạng thái:**
   - Nếu `state: "blocked"` (thiếu artifact): hiển thị thông báo, gợi ý dùng openspec-continue-change
   - Nếu `state: "all_done"`: chúc mừng, gợi ý archive
   - Trường hợp khác: tiến hành triển khai

4. **Đọc các file ngữ cảnh**

   Đọc các file được liệt kê trong `contextFiles` từ kết quả apply instructions.
   Các file phụ thuộc vào schema đang dùng:
   - **spec-driven**: proposal, specs, design, tasks
   - Schema khác: theo contextFiles từ kết quả CLI

5. **Hiển thị tiến độ hiện tại**

   Hiển thị:
   - Schema đang dùng
   - Tiến độ: "N/M task hoàn thành"
   - Tổng quan các task còn lại
   - Hướng dẫn động từ CLI

6. **Triển khai task (lặp cho đến khi xong hoặc bị chặn)**

   Với mỗi task đang chờ:
   - Hiển thị task nào đang được thực hiện
   - **Tự khám phá vùng codebase liên quan** — không chỉ dựa vào các artifact kế hoạch. Đọc các file thực tế bạn sẽ chỉnh sửa, theo dõi cách chúng kết nối, hiểu trạng thái hiện tại.
   - **Tra cứu tài liệu API khi không chắc** — nếu task liên quan đến thư viện/hàm bạn không chắc (tham số chính xác, kiểu trả về, hành vi theo phiên bản), ủy thác cho `nvsx-doc-lookup` với mục tiêu cụ thể trước khi viết code.
   - Thực hiện các thay đổi code cần thiết
   - Giữ thay đổi tối thiểu và tập trung
   - **Đánh dấu task hoàn thành NGAY LẬP TỨC** trong file tasks: `- [ ]` → `- [x]` — KHÔNG gộp cập nhật, KHÔNG chờ đến khi nhiều task xong. Mỗi task được đánh dấu ngay khi hoàn thành.
   - Tiếp tục task tiếp theo

   **Cổng xác minh mốc quan trọng:**

   Khi bạn hoàn thành subtask cuối cùng của một nhóm task lớn (ví dụ: tất cả task 1.x xong, sắp bắt đầu 2.x), DỪNG lại và chạy xác minh trước khi tiếp tục:

   1. Nếu `openspec/changes/<tên>/verify-fixes.md` tồn tại, đọc nó.
   2. Chạy các verifier áp dụng bằng **Background Verification Protocol (BVP)** với ngữ cảnh những gì vừa hoàn thành (tên change, đường dẫn artifact, task đã hoàn thành trong nhóm này, file đã chỉnh sửa):
      - `nvsx-verifier` (luôn luôn) — bao gồm chú thích `← (verify: ...)` từ các task đã hoàn thành
      - `nvsx-arch-verifier` (luôn luôn) — bao gồm ngôn ngữ/framework dự án
      - `nvsx-uiux-verifier` (nếu change có UI) — bao gồm danh sách file UI
      - `nvsx-test-verifier` (nếu dự án có test framework) — bao gồm lệnh test
      - Nếu verify-fixes.md tồn tại, thêm vào MỖI hướng dẫn verifier: `**Các vấn đề đã sửa trước đó (từ verify-fixes.md):**` theo sau là nội dung file
   3. Sửa các vấn đề từ mỗi verifier khi kết quả đến (theo BVP — không chờ tất cả xong)
   4. Khi tất cả verifier xong và tất cả vấn đề có thể sửa đã được giải quyết: nếu sạch → tiến hành nhóm task tiếp theo

   Điều này ngăn lỗi tích lũy qua các nhóm task. Một bug trong nhóm 1 không được phát hiện có thể lan sang nhóm 2, 3, v.v.

   **Tạm dừng nếu:**
   - Task không rõ ràng → hỏi để làm rõ
   - Triển khai phát hiện vấn đề thiết kế → gợi ý cập nhật artifact
   - Gặp lỗi hoặc bị chặn → báo cáo và chờ hướng dẫn
   - Người dùng ngắt

7. **Khi hoàn thành hoặc tạm dừng, hiển thị trạng thái**

   Hiển thị:
   - Các task đã hoàn thành trong phiên này
   - Tiến độ tổng thể: "N/M task hoàn thành"
   - Nếu tạm dừng: giải thích lý do và chờ hướng dẫn
   - Nếu tất cả xong HOẶC chỉ còn task thủ công/kiểm thử: **tiến hành tự động xác minh** (bước 8)

8. **Tự động xác minh khi hoàn thành**

   Khi tất cả task hoàn thành HOẶC chỉ còn task thủ công/kiểm thử, **tự động chạy xác minh**:

   ```
   ## Tất cả Task Hoàn Thành — Đang Chạy Xác Minh...
   ```

   Phát hiện đặc điểm change (logic tương tự bước 4 của nvsx-verify):
   - **Có UI**: quét artifact tìm từ khóa UI (component, page, modal, form, button, layout, CSS, style, responsive, animation)
   - **Có tests**: dự án có test framework VÀ change chạm vào code có thể test

   Chạy tất cả verifier áp dụng bằng **Background Verification Protocol (BVP)**:

   - `nvsx-verifier` (luôn luôn) — với đầy đủ ngữ cảnh artifact, ngữ cảnh triển khai, và điểm tập trung xác minh từ chú thích task
   - `nvsx-arch-verifier` (luôn luôn) — với ngữ cảnh ngôn ngữ/framework dự án
   - `nvsx-uiux-verifier` (nếu change có UI) — với danh sách file UI
   - `nvsx-test-verifier` (nếu dự án có test framework) — với tên test framework và lệnh test

   Nếu `openspec/changes/<tên>/verify-fixes.md` tồn tại, đọc nó.

   Mẫu hướng dẫn cho mỗi verifier:
   ```
   Xác minh triển khai cho change: <tên>

   **Artifacts:**
   - Tasks: openspec/changes/<tên>/tasks.md
   - Proposal: openspec/changes/<tên>/proposal.md
   - Design: openspec/changes/<tên>/design.md (nếu tồn tại)
   - Specs: openspec/changes/<tên>/specs/*.md (nếu tồn tại)

   **Ngữ cảnh triển khai:**
   - [các task đã hoàn thành trong phiên này]
   - [các file đã chỉnh sửa]

   **Các vấn đề đã sửa trước đó (từ verify-fixes.md):**
   [nội dung verify-fixes.md, hoặc "Không có" nếu file không tồn tại]
   ```

   Thêm ngữ cảnh cụ thể cho từng verifier vào mỗi hướng dẫn (điểm tập trung xác minh cho nvsx-verifier, file UI cho nvsx-uiux-verifier, v.v.).

   Xử lý kết quả theo BVP — sửa vấn đề từ mỗi verifier khi nó trả về, không chờ tất cả xong.

9. **Vòng lặp tự động sửa lỗi**

   Sau khi nhận báo cáo xác minh, sửa **tất cả** vấn đề được báo cáo — CRITICAL, WARNING, và SUGGESTION. Không chỉ những cái dễ.

   **Sửa không cần hỏi** (những cái này không cần input người dùng):
   - CRITICAL: Task chưa hoàn thành, thiếu triển khai, chức năng bị hỏng
   - WARNING: Sai lệch spec/design, thiếu coverage kịch bản, test thất bại
   - SUGGESTION: Không nhất quán pattern, sai lệch code style, cải tiến nhỏ
   - Lỗi type, lỗi lint → sửa code
   - Task chưa hoàn thành nhưng thực ra đã xong → đánh dấu checkbox

   **Bỏ qua và thu thập** (thực sự cần quyết định của người dùng):
   - Yêu cầu mơ hồ với nhiều cách diễn giải hợp lệ
   - Quyết định thiết kế cần xem xét lại
   - Câu hỏi về phạm vi (ranh giới tính năng không rõ)

   **Ghi log sửa lỗi xác minh** — Sau khi sửa vấn đề, thêm vào `openspec/changes/<tên>/verify-fixes.md`. Log này ngăn việc xác minh lại đánh dấu lại các vấn đề đã được sửa.

   Định dạng:
   ```markdown
   ## [YYYY-MM-DD] Vòng N (từ nvsx-apply tự động xác minh)

   ### nvsx-verifier
   - Đã sửa: <mô tả ngữ nghĩa về những gì đã sửa và ở đâu>

   ### nvsx-arch-verifier
   - Đã sửa: <mô tả ngữ nghĩa về những gì đã sửa và ở đâu>

   ### nvsx-uiux-verifier
   - Đã sửa: <mô tả ngữ nghĩa về những gì đã sửa và ở đâu>

   ### nvsx-test-verifier
   - Đã sửa: <mô tả ngữ nghĩa về những gì đã sửa và ở đâu>
   ```

   Chỉ bao gồm các section cho verifier đã báo cáo vấn đề bạn đã sửa. Chỉ log các sửa lỗi xuất phát từ kết quả xác minh — KHÔNG log sửa lỗi từ triển khai lần đầu hoặc thay đổi do người dùng yêu cầu.

   Sau khi ghi log, **xác minh lại TOÀN BỘ triển khai** — chạy tất cả verifier áp dụng lại bằng **BVP** (background, sửa-khi-đến) trên toàn bộ change (tất cả artifact, tất cả file), không chỉ phần bạn đã sửa. Một sửa lỗi ở một vùng có thể phá vỡ vùng khác. Bao gồm verify-fixes.md đã cập nhật trong mỗi hướng dẫn verifier.

   ```
   ## Đang Tự Động Sửa Lỗi... (vòng 1)

   Đã sửa: [CRITICAL] Thiếu triển khai cho yêu cầu X
   Đã sửa: [WARNING] Sai lệch spec trong auth.php:45
   Đã sửa: [SUGGESTION] Không nhất quán pattern trong utils.php
   Bỏ qua: Yêu cầu mơ hồ (cần input của bạn)
   Đã ghi log sửa lỗi vào verify-fixes.md

   Đang xác minh lại toàn bộ triển khai...
   ```

   **Lặp** — sửa-khi-đến → log → xác minh lại toàn bộ (BVP) → sửa-khi-đến → log → xác minh lại toàn bộ — cho đến khi:
   - Báo cáo hiển thị 0 CRITICAL, 0 WARNING, 0 SUGGESTION
   - HOẶC chỉ còn các mục cần quyết định người dùng (những cái bị bỏ qua)

   Mỗi vòng dùng BVP từ bước 8 (tất cả verifier áp dụng ở background, sửa khi kết quả đến, tất cả artifact, tất cả ngữ cảnh, tất cả vấn đề đã sửa trước đó). Không có lối tắt.

10. **Tư thế tinh chỉnh (khi người dùng yêu cầu sửa hoặc cải thiện code bạn đã viết)**

    Khi người dùng quay lại với "cái này không hoạt động", "sửa cái này", "tinh chỉnh cái này", hoặc chỉ ra vấn đề với code bạn đã triển khai:

    **Khám phá lại trước khi vá** — KHÔNG chỉnh sửa code bạn đã viết ngay lập tức. Trước tiên:
    - Đọc lại các vùng codebase liên quan (không chỉ các thay đổi trước đó của bạn)
    - Hiểu hành vi thực tế so với hành vi mong đợi
    - Theo dõi luồng thực thi để tìm nguyên nhân thực sự

    **Chẩn đoán nguyên nhân gốc, không phải triệu chứng** — Tự hỏi:
    - Vấn đề có trong CODE CỦA TÔI, hay trong cách code của tôi tương tác với code hiện có?
    - Cách tiếp cận có sai về cơ bản, hay chỉ là lỗi nhỏ?
    - Nếu tôi vá chỗ này, liệu cùng loại vấn đề có xuất hiện ở nơi khác không?

    **Viết lại thay vì vá** — Nếu nguyên nhân gốc là cách tiếp cận sai:
    - KHÔNG thêm workaround hoặc band-aid lên code hiện có
    - Viết lại phần bị ảnh hưởng từ đầu với cách tiếp cận đúng
    - Viết lại 50 dòng đúng còn rẻ hơn vá 5 dòng tạo ra 3 bug nữa

    **Phá vỡ vòng lặp an toàn** — Bạn có quyền:
    - Xóa code bạn đã viết trong phiên này và bắt đầu lại
    - Thay đổi hoàn toàn cách tiếp cận nếu bằng chứng cho thấy nó sai
    - Không đồng ý với kế hoạch ban đầu nếu triển khai cho thấy nó có lỗi
    - Gợi ý cập nhật artifact (design.md, tasks.md) để phản ánh cách tiếp cận tốt hơn

11. **Kết quả cuối cùng**

    **Nếu tất cả sạch:**
    ```
    ## Triển Khai Hoàn Thành & Đã Xác Minh

    **Change:** <tên-change>
    **Tiến độ:** 7/7 task hoàn thành
    **Xác minh:** Tất cả kiểm tra đã qua

    Sẵn sàng lưu trữ → `/nvsx-archive <tên>`
    ```

    **Nếu còn vấn đề thủ công:**
    ```
    ## Triển Khai Hoàn Thành (Còn Vấn Đề Thủ Công)

    **Change:** <tên-change>
    **Tiến độ:** 7/7 task hoàn thành
    **Đã tự động sửa:** [N] vấn đề
    **Còn lại:** [M] vấn đề thủ công

    ### Vấn Đề Cần Quyết Định Của Bạn:
    1. [vấn đề] — [các lựa chọn]
    2. [vấn đề] — [các lựa chọn]

    Sau khi giải quyết, chạy `/nvsx-verify` lại hoặc tiến hành lưu trữ.
    ```

**Kết quả trong quá trình triển khai**

```
## Đang Triển Khai: <tên-change> (schema: <tên-schema>)

Đang làm task 3/7: <mô tả task>
[...đang triển khai...]
Task hoàn thành

Đang làm task 4/7: <mô tả task>
[...đang triển khai...]
Task hoàn thành
```

**Kết quả khi tạm dừng (gặp vấn đề)**

```
## Triển Khai Tạm Dừng

**Change:** <tên-change>
**Schema:** <tên-schema>
**Tiến độ:** 4/7 task hoàn thành

### Vấn Đề Gặp Phải
<mô tả vấn đề>

**Các lựa chọn:**
1. <lựa chọn 1>
2. <lựa chọn 2>
3. Cách tiếp cận khác

Bạn muốn làm gì?
```

---

**Direct Plan Mode (Chế độ B)**

Khi triển khai trực tiếp từ kế hoạch hội thoại mà không có openspec change:

1. **Trích xuất task từ ngữ cảnh hội thoại**

   Xem lại kế hoạch đã thảo luận trong `/nvsx-plan`. Xác định các task triển khai cụ thể từ các quyết định, yêu cầu và cách tiếp cận đã thảo luận. Dùng công cụ theo dõi task tích hợp của agent để tạo và quản lý danh sách task — KHÔNG tạo file task.

2. **Hiển thị tóm tắt kế hoạch và task**

   ```
   ## Triển khai từ kế hoạch hội thoại

   **Nội dung**: [tóm tắt 1-2 câu]
   **Cách tiếp cận**: [các quyết định chính từ kế hoạch]

   **Các task:**
   1. [task 1]
   2. [task 2]
   ...

   Bắt đầu triển khai...
   ```

3. **Triển khai task**

   Với mỗi task:
   - Hiển thị task nào đang được thực hiện
   - Khám phá vùng codebase liên quan
   - Tra cứu tài liệu API qua `nvsx-doc-lookup` khi không chắc
   - Thực hiện các thay đổi code
   - Giữ thay đổi tối thiểu và tập trung
   - Đánh dấu task hoàn thành trong công cụ theo dõi task ngay lập tức
   - Tiếp tục task tiếp theo

   **Tạm dừng nếu** cùng quy tắc như Chế độ A — task không rõ, vấn đề thiết kế, lỗi, hoặc người dùng ngắt.

4. **Tự động xác minh khi hoàn thành**

   Khi tất cả task xong, chạy xác minh bằng BVP. Vì không có file artifact, truyền ngữ cảnh kế hoạch qua hướng dẫn verifier:

   ```
   Xác minh triển khai cho kế hoạch trực tiếp:

   **Tóm tắt kế hoạch:**
   [tóm tắt những gì đã thảo luận và quyết định trong nvsx-plan]

   **Yêu cầu:**
   [các yêu cầu chính từ hội thoại]

   **Ngữ cảnh triển khai:**
   - [các task đã hoàn thành]
   - [các file đã chỉnh sửa]

   **Các vấn đề đã sửa trước đó:** Không có
   ```

   Chạy `nvsx-arch-verifier` (luôn luôn). Chạy `nvsx-uiux-verifier` (nếu có UI). Chạy `nvsx-test-verifier` (nếu có tests). Bỏ qua kiểm tra artifact `nvsx-verifier` (không có artifact để xác minh) — nhưng bao gồm nó nếu kế hoạch có các yêu cầu cụ thể có thể kiểm tra với code.

5. **Tự động sửa và kết quả**

   Cùng vòng lặp tự động sửa như Chế độ A (bước 9), nhưng không có verify-fixes.md (không có thư mục change). Sửa tất cả vấn đề, xác minh lại cho đến khi sạch.

   ```
   ## Triển Khai Hoàn Thành & Đã Xác Minh

   **Kế hoạch:** [tóm tắt]
   **Tiến độ:** N/N task hoàn thành
   **Xác minh:** Tất cả kiểm tra đã qua

   Để chính thức hóa thành openspec change → `/nvsx-ff`
   ```

---

**Background Verification Protocol (BVP)**

Khi chạy nhiều verifier, dùng thực thi background với sửa lỗi streaming để tối đa throughput:

1. Khởi chạy tất cả verifier áp dụng **ở background** (không chặn) — mỗi cái là một subagent background riêng biệt
2. **Sửa-khi-đến** — khi mỗi kết quả verifier đến:
   - Đọc báo cáo của nó ngay lập tức
   - Sửa tất cả vấn đề CRITICAL, WARNING, và SUGGESTION từ báo cáo đó ngay
   - KHÔNG chờ các verifier khác xong trước khi sửa
3. Tiếp tục sửa kết quả từ mỗi verifier khi chúng hoàn thành
4. Khi TẤT CẢ verifier đã trả về VÀ tất cả vấn đề có thể sửa đã được giải quyết → tiến hành bước tiếp theo

Pattern này áp dụng ở mọi nơi verifier chạy: cổng mốc, tự động xác minh, và vòng lặp xác minh lại. Lợi ích rất đáng kể — thay vì chờ không làm gì trong khi verifier chậm nhất xong, bạn đã sửa vấn đề từ những cái nhanh hơn rồi.

**Các quy tắc bảo vệ**
- Tiếp tục làm task cho đến khi xong hoặc bị chặn
- Luôn đọc file ngữ cảnh trước khi bắt đầu (từ kết quả apply instructions)
- Nếu task mơ hồ, tạm dừng và hỏi trước khi triển khai
- Nếu triển khai phát hiện vấn đề, tạm dừng và gợi ý cập nhật artifact
- Giữ thay đổi code tối thiểu và giới hạn trong từng task — nhưng khi tinh chỉnh, ưu tiên viết lại hơn vá nếu nguyên nhân gốc đòi hỏi
- **Theo dõi task thời gian thực** — Đánh dấu mỗi task `[x]` NGAY KHI xong. Không bao giờ gộp cập nhật checkbox.
- **Cổng xác minh mốc** — Trước khi bắt đầu nhóm task lớn mới (ví dụ: chuyển từ task 1.x sang 2.x), PHẢI chạy tất cả verifier áp dụng bằng BVP (background, sửa-khi-đến) và giải quyết tất cả vấn đề CRITICAL/WARNING trước.
- Tạm dừng khi gặp lỗi, bị chặn, hoặc yêu cầu không rõ — không đoán mò
- Dùng contextFiles từ kết quả CLI, không giả định tên file cụ thể
- **Tự động xác minh khi hoàn thành** — PHẢI chạy tất cả verifier áp dụng bằng BVP (background, sửa-khi-đến) khi tất cả task AI có thể làm xong (kể cả khi còn task thủ công/kiểm thử). Luôn luôn: nvsx-verifier + nvsx-arch-verifier. Có điều kiện: nvsx-uiux-verifier (thay đổi UI), nvsx-test-verifier (dự án có tests).
- **Tự động sửa TẤT CẢ vấn đề** — sửa CRITICAL, WARNING, và SUGGESTION khi mỗi kết quả verifier đến. Chỉ bỏ qua các mục thực sự cần quyết định người dùng.
- **Vòng lặp xác minh lại toàn bộ** — sau khi sửa, xác minh lại TOÀN BỘ triển khai bằng BVP (không chỉ phần đã sửa). Lặp cho đến khi báo cáo sạch hoặc chỉ còn mục cần quyết định người dùng.
- **Log sửa lỗi xác minh** — sau khi sửa vấn đề từ kết quả xác minh, PHẢI thêm vào `verify-fixes.md` trong thư mục change. Nhóm theo verifier, dùng mô tả ngữ nghĩa. Điều này ngăn xác minh lại đánh dấu lại các vấn đề đã sửa. Luôn truyền nội dung verify-fixes.md cho verifier.
- **Direct Plan Mode** — khi không có openspec change nhưng hội thoại có ngữ cảnh kế hoạch, triển khai trực tiếp bằng Chế độ B. Theo dõi task bằng công cụ theo dõi task tích hợp của agent, không dùng file. Gợi ý `/nvsx-ff` nếu độ phức tạp kế hoạch cao (>10 task, đa thành phần, cần tài liệu thiết kế).

**Tích hợp Workflow Linh Hoạt**

Skill này hỗ trợ mô hình "hành động trên một change":

- **Có thể gọi bất cứ lúc nào**: Trước khi tất cả artifact xong (nếu task tồn tại), sau khi triển khai một phần, xen kẽ với các hành động khác
- **Cho phép cập nhật artifact**: Nếu triển khai phát hiện vấn đề thiết kế, gợi ý cập nhật artifact — không bị khóa theo giai đoạn, làm việc linh hoạt
- **Tự động xác minh khi hoàn thành**: Khi tất cả task xong, tự động xác minh và sửa vấn đề

**Tham chiếu Subagent**

| Subagent | Mục đích |
|----------|---------|
| `nvsx-verifier` | Xác minh độc lập triển khai (ngữ cảnh sạch) |
| `nvsx-arch-verifier` | Kiến trúc, design pattern, thay thế thư viện |
| `nvsx-uiux-verifier` | Xác minh chất lượng UI/UX (khi change có UI) |
| `nvsx-test-verifier` | Xác minh coverage và chất lượng test (khi dự án có tests) |
| `nvsx-doc-lookup` | Tra cứu tài liệu API/hàm — chữ ký chính xác, tham số, hành vi theo phiên bản |

**Gợi ý chuyển đổi chế độ**

Sau khi triển khai hoàn thành (với xác minh) hoặc tạm dừng:

- Để suy nghĩ/khám phá/brainstorm → `/nvsx-plan`
- Để tạo change mới → `/nvsx-ff`
- Để xác minh lại thủ công → `/nvsx-verify`
- Để lưu trữ công việc đã hoàn thành → `/nvsx-archive`

**QUAN TRỌNG**: Sau khi lệnh này kết thúc, KHÔNG tự động tiếp tục viết code trong các tin nhắn người dùng tiếp theo trừ khi người dùng yêu cầu rõ ràng tiếp tục triển khai hoặc gọi `/nvsx-apply` lại. Nếu người dùng gọi `/nvsx-plan`, BẠN PHẢI chuyển hoàn toàn sang chế độ khám phá — không viết code. Nếu người dùng gọi `/nvsx-ff`, BẠN PHẢI chuyển hoàn toàn sang chế độ tạo change — không viết code, không tiếp tục task.

Nội dung sau đây là yêu cầu của người dùng:
