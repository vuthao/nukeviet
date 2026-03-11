---
name: nvsx-git-pull
description: Pull thay đổi mới nhất từ remote với giải quyết xung đột — tự động giải quyết xung đột đơn giản, gợi ý workflow nvsx-ff → nvsx-apply cho xung đột phức tạp.
---

Bạn đang sử dụng kỹ năng nvsx-git-pull, được mô tả như sau:

Pull thay đổi mới nhất từ remote — tự động giải quyết xung đột đơn giản, gợi ý workflow openspec cho xung đột phức tạp.

## Ngữ cảnh NukeViet

Khi pull thay đổi cho dự án NukeViet 5.x, cần lưu ý:

- **Cấu trúc module**: `src/modules/<tên>/` — xung đột thường xảy ra ở `functions.php`, `admin.functions.php`
- **Cấu trúc theme**: `src/themes/<tên>/` — xung đột thường xảy ra ở file `.tpl` và `theme.php`
- **Database**: Xung đột ở `action_mysql.php` cần merge cẩn thận — tham chiếu skill `nukeviet-mysql`
- **Ngôn ngữ**: Xung đột ở `language/vi.php`, `language/en.php` — tham chiếu skill `nukeviet-language`
- **Build assets**: Sau khi pull, có thể cần chạy `npm run watch-admin` hoặc `npm run watch-core` nếu có thay đổi SCSS

WORKFLOW

Giai đoạn 1 — KIỂM TRA TRƯỚC KHI PULL

Trước khi pull, đánh giá trạng thái workspace:

1. Kiểm tra các thay đổi chưa commit bằng `git status`
   - Nếu working tree có thay đổi: yêu cầu người dùng stash hoặc commit trước
   - Đề nghị chạy `git stash` tự động nếu người dùng đồng ý
2. Xác định nhánh hiện tại và upstream remote/branch của nó
   - Nếu chưa cấu hình upstream, hỏi người dùng muốn pull từ remote/branch nào
3. Chạy `git fetch` để lấy trạng thái remote mới nhất
4. Xem trước những gì sắp được kéo về:

```
PULL PREVIEW
═══════════════════════════════════════
Nhánh hiện tại     : feature/xyz
Remote             : origin/feature/xyz
Local đang chậm hơn: 14 commits

Thay đổi sắp về: 23 file sửa đổi, 4 thêm mới, 2 xóa
Local chưa push : 3 commits, 8 file sửa đổi

Xung đột tiềm năng: ~5 file
═══════════════════════════════════════
```

5. Nếu không có thay đổi mới, báo "Already up to date" và dừng
6. Nếu có thay đổi mới, hỏi người dùng xác nhận trước khi merge
7. Lưu backup ref: `git tag backup/pull-{YYYYMMDD-HHmmss}` trước khi merge

Giai đoạn 2 — MERGE

Chạy `git merge` với nhánh remote đã fetch.

- Nếu merge hoàn thành sạch — bỏ qua đến Giai đoạn 4
- Nếu có xung đột — tiến hành Giai đoạn 3

Giai đoạn 3 — GIẢI QUYẾT XUNG ĐỘT

Xử lý xung đột qua 3 bước: phân tích & nhóm → hỏi quyết định người dùng → chuyển sang openspec để giải quyết.

Bước 1 — PHÂN TÍCH & NHÓM

Đọc TẤT CẢ các file xung đột. Hiểu ý nghĩa ngữ nghĩa của từng xung đột, không chỉ xem diff. Nhóm các xung đột liên quan theo chủ đề logic (tính năng, module, mối quan tâm nghiệp vụ).

Tự động giải quyết xung đột đơn giản ngay lập tức (KHÔNG hỏi người dùng):
- Thêm hoặc xóa câu lệnh import/require
- Khác biệt về định dạng, khoảng trắng, ký tự xuống dòng
- Đổi tên/di chuyển file mà nội dung không thay đổi
- Các phần thêm mới không chồng chéo (code mới ở các vùng khác nhau)
- Chỉ thay đổi comment
- File tự động sinh (lock files, build outputs)
- Thay đổi giống nhau ở cả hai phía

Trình bày bản đồ xung đột:

```
CONFLICT MAP
═══════════════════════════════════════
Tổng cộng: 8 xung đột trong 8 file

Nhóm A — Vòng đời token xác thực (3 file)
  src/services/auth.ts
  src/middleware/verify.ts
  src/config/auth.ts
  LOCAL: token 48h + logic refresh
  REMOTE: token 1h + logic rotation

Nhóm B — Quy tắc giảm giá thanh toán (2 file)
  src/services/payment.ts
  src/utils/pricing.ts
  LOCAL: giới hạn 30%, áp dụng sau thuế
  REMOTE: giới hạn 50%, áp dụng trước thuế

Độc lập — src/api/routes.ts
  LOCAL: thêm endpoint /v2/users
  REMOTE: xóa endpoint /v1/users

Tự động giải quyết (2 file)
  ✓ src/utils/helpers.ts — cả hai phía thêm imports
  ✓ package-lock.json — được tái tạo
═══════════════════════════════════════
```

Quy tắc nhóm:
- Các file triển khai cùng tính năng/mối quan tâm thuộc về nhau
- Nếu các xung đột có phụ thuộc logic (ví dụ: config + code đọc nó), nhóm chúng lại
- Nếu xung đột không liên quan đến nhóm nào, đánh dấu là Độc lập
- Không bao giờ ép nhóm các xung đột không liên quan

Bước 2 — HỎI QUYẾT ĐỊNH NGHIỆP VỤ

**Nếu không còn xung đột phức tạp nào** → bỏ qua đến Giai đoạn 4.

Hỏi MỘT quyết định cho mỗi nhóm — không phải mỗi file. Với xung đột Độc lập, hỏi từng cái một.

```
═══════════════════════════════════════
QUYẾT ĐỊNH #1/3 — Vòng đời token xác thực
Ảnh hưởng: 3 file
═══════════════════════════════════════

Hướng tiếp cận LOCAL:
  Token tồn tại 48h, refresh khi hết hạn
  → UX tốt hơn, ít đăng xuất hơn
  → Rủi ro cao hơn nếu token bị lộ

Hướng tiếp cận REMOTE:
  Token tồn tại 1h, rotation liên tục
  → Bảo mật mạnh hơn
  → Xử lý phía client phức tạp hơn

Hai hướng này KHÔNG TƯƠNG THÍCH — phải chọn một.

1. Giữ LOCAL (48h + refresh)
2. Giữ REMOTE (1h + rotation)
3. Tùy chỉnh (mô tả ý định, tôi sẽ đưa vào plan)

Gợi ý: REMOTE (lựa chọn 2)
   Nhánh của bạn là feature/security-hardening — token rotation
   phù hợp với mục đích bảo mật của nhánh.

Chọn [1/2/3]:
═══════════════════════════════════════
```

Quy tắc chất lượng câu hỏi:
- Giải thích MỖI phía làm GÌ và TẠI SAO quan trọng — không chỉ hiển thị diff thô
- Nêu rõ đánh đổi: bảo mật vs UX, đơn giản vs linh hoạt, v.v.
- Nêu rõ các hướng có tương thích (có thể merge cả hai) hay không tương thích (phải chọn)
- Nếu quyết định của nhóm phụ thuộc vào kết quả nhóm trước, hỏi theo thứ tự phụ thuộc và tham chiếu quyết định trước
- Nếu cần thêm ngữ cảnh để đặt câu hỏi rõ ràng, hãy điều tra trước — đọc code liên quan, trace call sites — trước khi hỏi. Không bao giờ đặt câu hỏi mơ hồ.

Quy tắc gợi ý:
- Với mỗi quyết định, đưa ra gợi ý sau các lựa chọn
- Dựa gợi ý trên mục đích của nhánh hiện tại — đọc tên nhánh, commit messages gần đây, và mô tả PR (nếu có)
- Mục đích nghiệp vụ của nhánh được ưu tiên
- Khi cả hai phía đều hợp lệ như nhau, gợi ý dựa trên: ít rủi ro runtime nhất > thay đổi gần nhất > hướng đơn giản hơn
- Luôn giải thích TẠI SAO trong một câu gắn với ngữ cảnh nhánh
- Làm rõ đây chỉ là gợi ý — người dùng luôn quyết định

Bước 3 — CHUYỂN SANG OPENSPEC

Sau khi thu thập TẤT CẢ quyết định từ người dùng, chuẩn bị tóm tắt giải quyết xung đột và chuyển sang workflow openspec.

1. Trình bày tóm tắt quyết định để người dùng xác nhận:

```
TÓM TẮT QUYẾT ĐỊNH
═══════════════════════════════════════
Nhóm A — Vòng đời token xác thực → REMOTE
Nhóm B — Giảm giá thanh toán → LOCAL
Độc lập — routes.ts → Tùy chỉnh: giữ /v2, xóa /v1

Tự động giải quyết: 2 file
═══════════════════════════════════════
Xác nhận các quyết định này? [yes/no]
```

2. Sau khi người dùng xác nhận, xuất mô tả giải quyết xung đột cho `/nvsx-ff`:

   Mô tả phải bao gồm:
   - Tên change: `resolve-merge-conflicts-{YYYYMMDD}`
   - Mỗi nhóm với quyết định đã xác nhận (LOCAL/REMOTE/Tùy chỉnh + ý định người dùng)
   - Mỗi file xung đột với phân tích LOCAL vs REMOTE
   - Ngữ cảnh và mục đích nhánh
   - Đủ chi tiết để nvsx-ff tạo artifacts đúng mà không cần đọc lại các file xung đột

3. Gợi ý bước tiếp theo:

```
Đã xác nhận quyết định. Bước tiếp theo:

1. Tạo plan → /nvsx-ff resolve-merge-conflicts-{YYYYMMDD}
   (tóm tắt xung đột với quyết định của bạn đã sẵn sàng ở trên)
2. Đã có plan? → /nvsx-apply để triển khai giải quyết
3. Sau khi giải quyết → /nvsx-git-pull lại để hoàn tất (Giai đoạn 4)
```

Giai đoạn 4 — XÁC MINH

Giai đoạn này chạy khi:
- Merge hoàn thành sạch (không có xung đột), HOẶC
- Người dùng quay lại sau khi giải quyết xung đột qua `/nvsx-apply`

Nếu quay lại sau nvsx-apply: kiểm tra tất cả file xung đột đã được giải quyết (không còn conflict markers), sau đó hoàn tất merge commit.

1. Chạy build/lint nếu dự án có — báo cáo kết quả
2. Nếu stash được tạo ở Giai đoạn 1, nhắc người dùng `git stash pop` và kiểm tra xung đột stash
3. Trình bày tóm tắt:

```
PULL HOÀN TẤT
═══════════════════════════════════════
Commits đã merge  : 14
Tổng xung đột     : 8
  Tự động giải quyết: 3 (đơn giản)
  Giải quyết qua spec: 5 (qua nvsx-ff → nvsx-apply)
Backup ref        : backup/pull-20260209-160530
Change đã dùng    : resolve-merge-conflicts-20260209
═══════════════════════════════════════

CHI TIẾT GIẢI QUYẾT:
  src/services/auth.ts — Giữ REMOTE (token rotation)
  src/middleware/verify.ts — Cập nhật expiry + giữ rate-limiting local
  src/config/auth.ts — Đặt TOKEN_TTL=3600
  src/services/payment.ts — Giữ LOCAL (giới hạn 30%, sau thuế)
  src/api/routes.ts — Tùy chỉnh: giữ /v2, xóa /v1

TỰ ĐỘNG GIẢI QUYẾT (xem lại nếu cần):
  src/utils/helpers.ts — giữ cả hai imports
  package-lock.json — tái tạo
  src/styles/main.css — whitespace đã merge
```

4. Hỏi người dùng: **xác nhận** kết quả pull, hoặc **rollback** qua `git reset --hard backup/pull-{timestamp}`

XỬ LÝ HỦY BỎ

Nếu người dùng nói "hủy", "dừng", "rollback", hoặc "cancel" tại bất kỳ thời điểm nào:
1. Chạy `git merge --abort` nếu merge đang tiến hành
2. Pop stash nếu đã tạo (`git stash pop`)
3. Xác nhận working tree đã trở về trạng thái trước khi pull
4. Báo cáo những gì đã xảy ra

NGUYÊN TẮC

- Không bao giờ tự động giải quyết xung đột mà bạn không chắc chắn — khi nghi ngờ, phân loại là phức tạp
- Đơn giản = cơ học, không liên quan đến logic nghiệp vụ. Phức tạp = bất cứ điều gì cần phán đoán
- Nhóm các xung đột liên quan và hỏi một quyết định nghiệp vụ cho mỗi nhóm, không phải mỗi file
- Giải thích đánh đổi bằng ngôn ngữ con người — không chỉ hiển thị diff, hãy hiển thị tác động
- Người dùng PHẢI xác nhận quyết định trước khi chuyển sang nvsx-ff — không bao giờ bỏ qua bước quyết định
- Mô tả nvsx-ff phải tự đầy đủ — bao gồm tất cả ngữ cảnh xung đột và quyết định đã xác nhận để nvsx-ff không cần phân tích lại
- KHÔNG tự động gọi `/nvsx-ff` hoặc `/nvsx-apply` — gợi ý bước tiếp theo và để người dùng quyết định
- Mọi quyết định (tự động hoặc người dùng xác nhận) phải xuất hiện trong tóm tắt cuối
- Nếu stash được sử dụng, luôn nhắc người dùng về nó ở cuối

Nội dung sau đây là yêu cầu của người dùng:
