---
name: nvsx-ff
description: Tạo change mới với đầy đủ artifact cần thiết cho triển khai. Tự động khám phá và làm rõ khi yêu cầu còn mơ hồ trước khi tạo artifact.
---

Bạn đang sử dụng skill nvsx-ff, được mô tả như sau:

Tạo change mới — khám phá nếu cần, sau đó sinh toàn bộ artifact cho triển khai.

> **GHI CHÚ CLI**: Chạy tất cả lệnh `openspec` và `bash` trực tiếp từ thư mục gốc workspace. KHÔNG `cd` vào bất kỳ thư mục nào trước khi chạy. CLI `openspec` được thiết kế để chạy từ thư mục gốc dự án.

> **CÀI ĐẶT**: Nếu `openspec` chưa được cài, chạy `npm i -g @fission-ai/openspec@latest`. Nếu cần chạy `openspec init`, luôn dùng `openspec init --tools none`.

**⚠️ RESET RANH GIỚI CHẾ ĐỘ:** Khi lệnh này được gọi, **dừng mọi hoạt động trước đó** — dù bạn đang triển khai code (`/nvsx-apply`), khám phá (`/nvsx-plan`), hay bất kỳ việc gì khác. Bạn hiện đang ở **chế độ tạo change**. Không viết code. Không tiếp tục task trước đó. Bắt đầu mới.

**🚫 DANH SÁCH CẤM SUBAGENT:** KHÔNG BAO GIỜ dùng subagent `explore` hoặc `plan`. Đây là subagent chung từ kit khác và KHÔNG thuộc workflow này. Chỉ dùng subagent được liệt kê rõ ràng trong kit này (vd: `nvsx-uiux-designer`). Tự thực hiện khám phá và lập kế hoạch.

**Đầu vào**: Mô tả về thứ cần xây dựng, tùy chọn kèm tên kebab-case. Có thể từ mơ hồ ("trang đăng nhập") đến cụ thể ("thêm JWT auth với refresh token dùng Redis session store").

## Ngữ cảnh NukeViet

Khi tạo change cho dự án NukeViet 5.x, cần lưu ý:

- **Guard constants**: `NV_MAINFILE`, `NV_SYSTEM`, `NV_IS_MOD_*`, `NV_IS_FILE_ADMIN` — mọi file PHP phải kiểm tra guard constant phù hợp
- **Cấu trúc module**: `src/modules/<tên>/` với `funcs.php`, `admin.php`, `action.php`, `theme.php` — tham chiếu skill `nukeviet-module`
- **Cấu trúc theme**: `src/themes/<tên>/` với layout grid 24 cột — tham chiếu skill `nukeviet-theme`
- **Bảo mật**: `$nv_Request` cho input filtering, `nv_htmlspecialchars()` cho output encoding, `prepare+bindParam` cho SQL — tham chiếu skill `nukeviet-security`
- **Đa ngôn ngữ**: `$lang_module`, `$lang_global`, `$nv_Lang->loadModule()` — tham chiếu skill `nukeviet-language`
- **Hook system**: `nv_add_hook()`, `nv_apply_hook()` — tham chiếu skill `nukeviet-hook`
- **Cache**: `$nv_Cache->db()`, `setItem/getItem` — tham chiếu skill `nukeviet-cache`
- **Database**: `$db_slave` / `$db`, prefix đa ngôn ngữ — tham chiếu skill `nukeviet-mysql`

Khi tạo artifact (proposal, design, specs, tasks), luôn bao gồm context NukeViet phù hợp: guard constants cần thiết, security patterns, cấu trúc file liên quan.

---

## Giai đoạn 0: Kiểm tra ngữ cảnh

Trước khi đánh giá yêu cầu của người dùng, kiểm tra những gì đã tồn tại:

```bash
openspec list --json
```

**Nếu có change đang hoạt động**, người dùng có thể muốn:
- **Tạo change hoàn toàn mới** — tiến hành bình thường sang Giai đoạn 1
- **Cập nhật artifact của change hiện có** — vd: "Tôi quên thêm validation email vào change auth"

**Cách phân biệt:**
- Đầu vào của người dùng rõ ràng liên quan đến change đang hoạt động → hỏi: "Bạn có change đang hoạt động `<tên>`. Muốn cập nhật artifact của nó, hay tạo change riêng?"
- Đầu vào không liên quan đến change nào → tiến sang Giai đoạn 1 (change mới)
- Người dùng nói rõ "mới" hoặc cung cấp tên mới → tiến sang Giai đoạn 1

**Nếu cập nhật change hiện có**: Bỏ qua `openspec new change`, đi thẳng đến Giai đoạn 2 bước 3 (lấy status) dùng tên change hiện có. Chỉ cập nhật artifact cần thay đổi.

---

## Giai đoạn 1: Hiểu yêu cầu

Đánh giá đầu vào của người dùng để quyết định giai đoạn tiếp theo.

**Nếu không có đầu vào**, hỏi họ muốn xây dựng gì (câu hỏi mở, không có tùy chọn sẵn). KHÔNG tiến hành khi chưa có yêu cầu.

**Nếu có đầu vào**, đánh giá độ rõ ràng:

| Tín hiệu | Nghĩa là | Giai đoạn tiếp |
|-----------|----------|----------------|
| Phạm vi rõ ràng, công nghệ đã biết, đủ cụ thể để viết proposal | **Sẵn sàng** | → Giai đoạn 2 (Tạo) |
| Ý tưởng mơ hồ, thiếu quyết định quan trọng, nhiều hướng tiếp cận, ràng buộc chưa rõ | **Cần khám phá** | → Khám phá (bên dưới) |

**Thiên về hành động.** Nếu có thể đưa ra giả định hợp lý, đi sang Giai đoạn 2. Chỉ khám phá khi sự mơ hồ sẽ dẫn đến artifact sai cơ bản.

---

## Khám phá (khi cần)

**Mục tiêu**: Có đủ rõ ràng để tạo artifact tốt. Đây KHÔNG phải brainstorm mở — mà là khám phá có mục đích với đích đến.

**Quy tắc subagent**: Nếu dùng subagent trong khám phá (vd: phân tích codebase, lập kế hoạch), hướng dẫn chúng **chỉ báo cáo kết quả — không tạo file**.

**Thái độ**: Tò mò, trực quan, thực tế. Đặt câu hỏi tự nhiên. Dùng sơ đồ ASCII khi hữu ích. Khảo sát codebase để lấy ngữ cảnh.

**Bạn có thể làm:**
- Hỏi 2-3 câu hỏi làm rõ (không phải thẩm vấn)
- Phác thảo không gian vấn đề bằng sơ đồ ASCII
- Khảo sát codebase để phát hiện pattern, điểm tích hợp, hoặc ràng buộc liên quan
- So sánh ngắn gọn các hướng tiếp cận nếu có ngã rẽ thực sự
- Tra cứu tài liệu API qua `nvsx-doc-lookup` nếu hướng tiếp cận phụ thuộc vào hành vi cụ thể của thư viện

**Giữ tập trung.** Bạn đang khám phá để TẠO, không phải khám phá để khám phá. Khi có đủ thông tin để viết proposal tốt, tiến lên.

**Khi đủ rõ ràng**, trình bày tóm tắt ngắn và xin xác nhận:

```
## Sẵn sàng tạo

**Nội dung**: [tóm tắt 1-2 câu về change]
**Hướng tiếp cận**: [quyết định kỹ thuật chính]
**Phạm vi**: [bao gồm gì, loại trừ gì]

Tạo change này? (có / thảo luận thêm)
```

- Người dùng xác nhận → Giai đoạn 2
- Người dùng muốn thảo luận thêm → tiếp tục khám phá
- Nếu khám phá cho thấy quá mơ hồ hoặc người dùng chỉ muốn suy nghĩ → gợi ý `/nvsx-plan` cho khám phá mở

---

## Giai đoạn 2: Tạo

Khi yêu cầu đã rõ (từ đầu vào hoặc sau khám phá):

1. **Tạo tên kebab-case** từ mô tả (vd: "thêm xác thực người dùng" → `them-xac-thuc-nguoi-dung`).

2. **Tạo thư mục change**
   ```bash
   openspec new change "<tên>"
   ```

3. **Lấy thứ tự tạo artifact**
   ```bash
   openspec status --change "<tên>" --json
   ```
   Parse: `applyRequires` (ID artifact cần trước khi triển khai) và `artifacts` (danh sách với status và dependencies).

4. **Tạo artifact theo thứ tự phụ thuộc**

   Dùng **TodoWrite tool** để theo dõi tiến độ.

   Với mỗi artifact có status `ready` (dependencies đã thỏa mãn):
   - Lấy hướng dẫn: `openspec instructions <artifact-id> --change "<tên>" --json`
   - JSON hướng dẫn bao gồm:
     - `context`: Bối cảnh dự án (ràng buộc cho bạn — KHÔNG đưa vào output)
     - `rules`: Quy tắc riêng cho artifact (ràng buộc cho bạn — KHÔNG đưa vào output)
     - `template`: Cấu trúc dùng cho file output
     - `instruction`: Hướng dẫn theo schema cho loại artifact này
     - `outputPath`: Nơi ghi artifact
     - `dependencies`: Artifact đã hoàn thành cần đọc để lấy ngữ cảnh
   - Đọc file dependency đã hoàn thành để lấy ngữ cảnh
   - Tạo file artifact dùng `template` làm cấu trúc
   - Áp dụng `context` và `rules` như ràng buộc — KHÔNG copy chúng vào file
   - Hiển thị tiến độ ngắn: "✓ Đã tạo <artifact-id>"

   Tiếp tục cho đến khi tất cả artifact trong `applyRequires` có `status: "done"`. Kiểm tra lại bằng `openspec status` sau mỗi artifact.

   Nếu artifact cần input từ người dùng (ngữ cảnh chưa rõ), hỏi và tiếp tục.

5. **Hiển thị status cuối cùng**
   ```bash
   openspec status --change "<tên>"
   ```

**Đầu ra**: Tên/vị trí change, artifact đã tạo, và: "Chạy `/nvsx-apply` để bắt đầu triển khai."

---

**Hướng dẫn tạo Artifact**

- Tuân theo trường `instruction` từ `openspec instructions` cho mỗi loại artifact
- Đọc artifact dependency để lấy ngữ cảnh trước khi tạo artifact mới
- Dùng `template` làm cấu trúc — điền vào các section
- **`context` và `rules` là ràng buộc cho BẠN, không phải nội dung cho file** — không bao giờ copy chúng vào output
- **Luôn viết file artifact bằng tiếng Việt** — bất kể ngôn ngữ hội thoại
- **Ghi chú điểm verify trong tasks.md** — Với task cuối của mỗi nhóm lớn hoặc task rủi ro cao, thêm ghi chú verify: `← (verify: cần kiểm tra gì)`. Điều này cho verifier biết CẦN kiểm tra sâu Ở ĐÂU và TÌM GÌ. Đặt ghi chú trên task cuối luồng (mọi thứ trước đó phải hoạt động để task này hoạt động) hoặc rủi ro cao (logic phức tạp, điểm tích hợp, bảo mật). Ví dụ:
  ```
  1. Thiết lập database
    1.1 Tạo bảng users
    1.2 Tạo bảng sessions
    1.3 Thêm migration script ← (verify: schema khớp design.md, migration chạy không lỗi)
  2. Endpoint xác thực
    2.1 POST /login
    2.2 POST /register
    2.3 POST /refresh-token ← (verify: tất cả endpoint khớp kịch bản spec, luồng refresh token hoạt động end-to-end)
  ```

**Rào chắn**
- Tạo TẤT CẢ artifact cần cho triển khai (theo `apply.requires` của schema)
- Luôn đọc artifact dependency trước khi tạo artifact mới
- Ưu tiên đưa ra quyết định hợp lý để giữ đà — chỉ hỏi khi thực sự không rõ
- Nếu change với tên đó đã tồn tại, gợi ý tiếp tục change đó thay vì tạo mới
- Xác minh mỗi file artifact tồn tại sau khi ghi trước khi chuyển sang artifact tiếp theo
- **Không khám phá quá mức** — tối đa 2-3 vòng câu hỏi trước khi tạo. Nếu vẫn chưa rõ, tạo với hiểu biết tốt nhất và ghi chú giả định trong proposal

Nội dung sau đây là yêu cầu của người dùng:
