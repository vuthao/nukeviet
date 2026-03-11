---
name: nvsx-archive
description: Lưu trữ change đã hoàn thành trong workflow. Dùng khi người dùng muốn hoàn tất và lưu trữ change sau khi triển khai xong.
---

---
model: claude-sonnet-4-5
---

Bạn đang sử dụng kỹ năng nvsx-archive, được mô tả như sau:

Lưu trữ change đã hoàn thành trong workflow.

## Ngữ cảnh NukeViet

Khi lưu trữ change cho dự án NukeViet 5.x, cần lưu ý:

- **Cấu trúc module**: `src/modules/<tên>/` — tham chiếu skill `nukeviet-module`
- **Cấu trúc theme**: `src/themes/<tên>/` — tham chiếu skill `nukeviet-theme`
- **Bảo mật**: Đảm bảo change đã qua review bảo mật trước khi archive — tham chiếu skill `nukeviet-security`
- **Testing**: Đảm bảo test đã pass trước khi archive — tham chiếu skill `nukeviet-testing`

> **LƯU Ý CLI**: Chạy tất cả lệnh `openspec` và `bash` trực tiếp từ thư mục gốc của workspace. KHÔNG `cd` vào bất kỳ thư mục nào trước khi chạy. CLI `openspec` được thiết kế để hoạt động từ thư mục gốc dự án.

> **CÀI ĐẶT**: Nếu `openspec` chưa được cài đặt, chạy `npm i -g @fission-ai/openspec@latest`. Nếu cần chạy `openspec init`, luôn dùng `openspec init --tools none`.

**🚫 DANH SÁCH ĐEN SUBAGENT:** KHÔNG BAO GIỜ dùng subagent `explore` hoặc `plan`. Đây là các subagent chung từ các kit khác và KHÔNG thuộc workflow này. Chỉ dùng các subagent được liệt kê rõ ràng trong kit này. Tự thực hiện công việc lưu trữ trực tiếp.

**Đầu vào**: Tùy chọn chỉ định tên change. Nếu bỏ qua, suy luận từ ngữ cảnh hội thoại hoặc tự động chọn.

**Các bước**

1. **Xác định change mục tiêu (phát hiện thông minh)**

   Xác định change cần lưu trữ theo thứ tự ưu tiên sau — KHÔNG hỏi trừ khi thực sự không rõ ràng:

   1. **Tên được cung cấp rõ ràng** → dùng trực tiếp
   2. **Ngữ cảnh hội thoại** → nếu người dùng gần đây đã chạy `/nvsx-apply <name>` hoặc `/nvsx-verify <name>` hoặc làm việc với một change cụ thể trong hội thoại này, tự động chọn và hiển thị: `Đã tự động chọn "<name>" (từ ngữ cảnh hội thoại)`
   3. **Change duy nhất đang hoạt động** → chạy `openspec list --json`, nếu chỉ có 1 change đang hoạt động (chưa lưu trữ), tự động chọn và hiển thị: `Đã tự động chọn "<name>" (change duy nhất đang hoạt động)`
   4. **Không rõ ràng** → nhiều change đang hoạt động và không có ngữ cảnh rõ ràng. Chỉ khi đó mới dùng **công cụ AskUserQuestion** để người dùng chọn. Chỉ hiển thị các change đang hoạt động cùng schema của chúng.

2. **Kiểm tra trạng thái artifact và task (không chặn tiến trình)**

   Chạy `openspec status --change "<name>" --json` để kiểm tra mức độ hoàn thành artifact.
   Đọc file tasks (thường là `tasks.md`) để kiểm tra các task chưa hoàn thành.

   Thu thập cảnh báo nhưng **KHÔNG hỏi xác nhận** — tiến hành tự động:

   - **Artifact chưa hoàn thành**: Ghi chú artifact nào chưa ở trạng thái `done` → đưa vào tóm tắt cuối dưới dạng cảnh báo
   - **Task chưa hoàn thành**: Đếm `- [ ]` so với `- [x]` → đưa vào tóm tắt cuối dưới dạng cảnh báo
   - **Không có file tasks**: Tiến hành mà không có cảnh báo liên quan đến task

3. **Kiểm tra verify fix log để đánh giá tác động đến spec**

   Nếu `openspec/changes/<name>/verify-fixes.md` tồn tại, đọc nó. Kiểm tra xem có bản sửa lỗi nào đã thay đổi hành vi được mô tả trong các artifact spec (proposal, design, specs) không. Nếu có, cập nhật các phần spec bị ảnh hưởng để khớp với triển khai thực tế trước khi đồng bộ. Chỉ cập nhật các phần bị ảnh hưởng trực tiếp bởi các bản sửa lỗi — không viết lại nội dung không liên quan.

4. **Tự động đồng bộ delta specs**

   Kiểm tra delta specs tại `openspec/changes/<name>/specs/`.

   - **Không có delta specs** → bỏ qua đồng bộ, tiến hành lưu trữ
   - **Delta specs tồn tại nhưng đã được đồng bộ** (main specs đã phản ánh tất cả thay đổi) → bỏ qua đồng bộ, tiến hành lưu trữ
   - **Delta specs tồn tại và cần đồng bộ** → hiển thị tóm tắt ngắn về những gì sẽ được đồng bộ, sau đó **tự động đồng bộ** bằng kỹ năng openspec-sync-specs (do agent thực hiện). KHÔNG hỏi về việc đồng bộ hay bỏ qua.

5. **Thực hiện lưu trữ**

   Tạo thư mục archive nếu chưa tồn tại:
   ```bash
   mkdir -p openspec/changes/archive
   ```

   Tạo tên đích sử dụng ngày hiện tại: `YYYY-MM-DD-<change-name>`

   **Kiểm tra xem đích đã tồn tại chưa:**
   - Nếu có: Báo lỗi, đề xuất đổi tên archive hiện có hoặc dùng ngày khác
   - Nếu không: Sao chép thư mục vào archive, sau đó xóa nguồn

   ⚠️ KHÔNG dùng `mv` hoặc `Move-Item` — chúng thất bại với lỗi "Permission Denied" trên một số hệ thống.

   ```bash
   cp -r openspec/changes/<name> openspec/changes/archive/YYYY-MM-DD-<name>
   rm -rf openspec/changes/<name>
   ```

6. **Hiển thị tóm tắt tổng hợp**

   Hiển thị một tóm tắt duy nhất bao gồm tất cả — kết quả và mọi cảnh báo thu thập được trong quá trình:

**Kết quả khi thành công**

```
## Lưu Trữ Hoàn Tất

**Change:** <change-name>
**Schema:** <schema-name>
**Đã lưu trữ tại:** openspec/changes/archive/YYYY-MM-DD-<name>/
**Specs:** ✓ Đã đồng bộ vào main specs (hoặc "Không có delta specs" hoặc "Đã đồng bộ")

⚠️ 2 artifact chưa hoàn thành: design, tasks
⚠️ 3/7 task chưa hoàn thành
(hoặc "Tất cả artifact hoàn thành. Tất cả task hoàn thành." nếu không có cảnh báo)

💡 **Gợi ý commit:**
`git commit -m "<type>: <những gì change đã thực hiện>"`
(type: feat, fix, refactor, chore, perf, docs)
```

**Các ràng buộc**
- Tự động chọn change khi có thể suy luận từ ngữ cảnh hội thoại hoặc khi chỉ có một change đang hoạt động
- Chỉ hỏi về việc chọn change khi thực sự không rõ ràng (nhiều change đang hoạt động, không có ngữ cảnh)
- Không bao giờ hỏi xác nhận về artifact hoặc task chưa hoàn thành — hiển thị cảnh báo trong tóm tắt
- Không bao giờ hỏi về quyết định đồng bộ — luôn tự động đồng bộ khi delta specs cần đồng bộ
- Dùng artifact graph (openspec status --json) để kiểm tra mức độ hoàn thành
- Giữ nguyên .openspec.yaml khi chuyển vào archive (nó di chuyển cùng thư mục)
- Hiển thị tóm tắt tổng hợp rõ ràng với tất cả cảnh báo ở cuối
- Dùng phương pháp openspec-sync-specs (do agent thực hiện) để đồng bộ

Nội dung sau đây là yêu cầu của người dùng:
