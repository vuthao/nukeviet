---
name: nvsx-apply-with-log
description: Triển khai task từ OpenSpec change với xác minh log runtime cho tính đúng đắn logic và UI/UX. Dùng khi người dùng muốn triển khai với xác minh dựa trên log — AI chèn verify log vào code, người dùng test thủ công, AI phân tích log để bắt bug.
---

Bạn đang sử dụng skill nvsx-apply-with-log, được mô tả như sau:

Triển khai task từ OpenSpec change — tương tự `nvsx-apply` nhưng có **xác minh log runtime**. Bạn chèn verify log vào code trong quá trình triển khai, sau đó sau khi auto-verify, người dùng test thủ công và cung cấp runtime log. Bạn phân tích log để bắt bug logic, vấn đề UI/UX, và các edge case mà kiểm tra tĩnh bỏ sót. Log được xóa sau khi xác minh sạch.

> **GHI CHÚ CLI**: Chạy tất cả lệnh `openspec` và `bash` trực tiếp từ thư mục gốc workspace. KHÔNG `cd` vào bất kỳ thư mục nào trước khi chạy. CLI `openspec` được thiết kế để hoạt động từ thư mục gốc dự án.

> **CÀI ĐẶT**: Nếu `openspec` chưa được cài, chạy `npm i -g @fission-ai/openspec@latest`. Nếu cần chạy `openspec init`, luôn dùng `openspec init --tools none`.

**MODE: TRIỂN KHAI** — Lệnh này đặt bạn vào chế độ triển khai. Bạn viết code, hoàn thành task, và chỉnh sửa file. Đây là NGƯỢC LẠI với chế độ khám phá (`/nvsx-plan`). Khi lệnh này kết thúc (hoàn thành hoặc tạm dừng), bạn vẫn ở trong ngữ cảnh triển khai cho đến khi người dùng chuyển chế độ rõ ràng.

**DANH SÁCH ĐEN SUBAGENT:** KHÔNG BAO GIỜ dùng subagent `explore` hoặc `plan`. Đây là các subagent chung từ kit khác và KHÔNG thuộc workflow này. Chỉ dùng subagent được liệt kê rõ ràng trong kit này (ví dụ: `nvsx-uiux-designer`). Tự thực hiện công việc triển khai trực tiếp.

**Đầu vào**: Tùy chọn chỉ định tên change. Nếu bỏ qua, kiểm tra xem có thể suy ra từ ngữ cảnh hội thoại không. Nếu mơ hồ hoặc không rõ ràng, BẮT BUỘC hỏi về các change có sẵn.

## Ngữ cảnh NukeViet

Khi làm việc với codebase NukeViet 5.x, lưu ý các đặc điểm sau:

**Guard constants** — Luôn kiểm tra các hằng số bảo vệ trước khi thực thi logic:
- `NV_MAINFILE` — xác nhận file được gọi qua entry point chính
- `NV_SYSTEM` — xác nhận đang chạy trong hệ thống NukeViet
- `NV_IS_MOD_*` — xác nhận module đang hoạt động (ví dụ: `NV_IS_MOD_USERS`)
- `NV_IS_FILE_ADMIN` — xác nhận đang ở khu vực admin

**Security patterns** — Bắt buộc dùng các pattern bảo mật chuẩn NukeViet:
- `$nv_Request` — filter input thay vì `$_GET`/`$_POST`/`$_REQUEST` trực tiếp
- `nv_htmlspecialchars()` — escape output HTML
- `prepare()` + `bindParam()` — truy vấn SQL an toàn, không nối chuỗi trực tiếp

**Cấu trúc module/theme NukeViet**:
- Module: `modules/<tên>/`, controller tại `modules/<tên>/funcs/`, template tại `modules/<tên>/templates/`
- Theme: `themes/<tên>/`, layout tại `themes/<tên>/layout/`, block tại `themes/<tên>/blocks/`
- Tham chiếu skill `nukeviet-module` và `nukeviet-theme` để biết cấu trúc chi tiết

**VLOG trong PHP NukeViet** — Dùng `error_log()` thay vì `console.log()`:
```php
error_log("[VLOG][ENTER] fn=processModule module=$module_name"); // [VLOG]
error_log("[VLOG][BRANCH] fn=checkPermission branch=admin_access user_id=$user_id result=true"); // [VLOG]
error_log("[VLOG][EXIT] fn=processModule status=success output_len=" . strlen($output)); // [VLOG]
```

Tham chiếu skill: `nukeviet-security` (bảo mật), `nukeviet-module` (cấu trúc module).

**Các bước**

1. **Chọn change**

   Nếu tên được cung cấp, dùng nó. Nếu không:
   - Suy ra từ ngữ cảnh hội thoại nếu người dùng đề cập đến change
   - Tự chọn nếu chỉ có một change đang hoạt động
   - Nếu mơ hồ, chạy `openspec list --json` để lấy danh sách change và dùng **AskUserQuestion tool** để người dùng chọn

   Luôn thông báo: "Đang dùng change: <tên>" và cách ghi đè (ví dụ: `/nvsx-apply-with-log <khác>`).

2. **Kiểm tra trạng thái để hiểu schema**
   ```bash
   openspec status --change "<tên>" --json
   ```
   Phân tích JSON để hiểu:
   - `schemaName`: Workflow đang dùng (ví dụ: "spec-driven")
   - Artifact nào chứa task (thường là "tasks" cho spec-driven, kiểm tra status cho các schema khác)

3. **Lấy hướng dẫn apply**

   ```bash
   openspec instructions apply --change "<tên>" --json
   ```

   Trả về:
   - Đường dẫn file ngữ cảnh (thay đổi theo schema - có thể là proposal/specs/design/tasks hoặc spec/tests/implementation/docs)
   - Tiến độ (tổng, hoàn thành, còn lại)
   - Danh sách task với trạng thái
   - Hướng dẫn động dựa trên trạng thái hiện tại

   **Xử lý các trạng thái:**
   - Nếu `state: "blocked"` (thiếu artifact): hiển thị thông báo, gợi ý dùng openspec-continue-change
   - Nếu `state: "all_done"`: chúc mừng, gợi ý archive
   - Nếu không: tiến hành triển khai

4. **Đọc file ngữ cảnh**

   Đọc các file được liệt kê trong `contextFiles` từ output hướng dẫn apply.
   Các file phụ thuộc vào schema đang dùng:
   - **spec-driven**: proposal, specs, design, tasks
   - Schema khác: theo contextFiles từ output CLI

5. **Hiển thị tiến độ hiện tại**

   Hiển thị:
   - Schema đang dùng
   - Tiến độ: "N/M task hoàn thành"
   - Tổng quan task còn lại
   - Hướng dẫn động từ CLI

6. **Triển khai task (lặp cho đến khi xong hoặc bị chặn)**

   Với mỗi task đang chờ:
   - Hiển thị task đang được thực hiện
   - **Tự khám phá vùng codebase liên quan** — không chỉ dựa vào artifact plan. Đọc các file thực tế bạn sẽ chỉnh sửa, theo dõi cách chúng kết nối, hiểu trạng thái hiện tại.
   - **Tra cứu tài liệu API khi không chắc** — nếu task liên quan đến thư viện/hàm bạn không chắc (params chính xác, kiểu trả về, hành vi theo phiên bản), ủy thác cho `nvsx-doc-lookup` với target cụ thể trước khi viết code.
   - Thực hiện các thay đổi code cần thiết
   - Giữ thay đổi tối thiểu và tập trung
   - **Chèn verify log** — mỗi task BẮT BUỘC có log `[VLOG]` bao phủ code bạn viết (xem Chèn Log bên dưới)
   - **Cổng tóm tắt log** — TRƯỚC KHI đánh dấu task hoàn thành, đếm và hiển thị số lần gọi log `[VLOG]` bạn đã thêm:
     ```
     Task X logs: 8 lần gọi [VLOG] — [ENTER]x2 [EXIT]x2 [BRANCH]x3 [POSITION]x1
     ```
     Nếu số lượng đáng ngờ thấp (ví dụ: 1-2 log cho task chạm nhiều hàm hoặc có nhiều nhánh), bạn đang lười. Quay lại và thêm log còn thiếu.
   - **Đánh dấu task hoàn thành NGAY LẬP TỨC** trong file tasks: `- [ ]` → `- [x]` — KHÔNG gộp cập nhật, KHÔNG chờ đến khi nhiều task xong. Mỗi task được đánh dấu ngay khi hoàn thành.
   - Tiếp tục task tiếp theo

   **Cổng xác minh milestone:**

   Khi bạn hoàn thành subtask cuối cùng của một nhóm task lớn (ví dụ: tất cả task 1.x xong, sắp bắt đầu 2.x), DỪNG lại và chạy xác minh trước khi tiếp tục:

   1. Nếu `openspec/changes/<tên>/verify-fixes.md` tồn tại, đọc nó.
   2. Chạy các verifier áp dụng **song song** với ngữ cảnh những gì vừa hoàn thành (tên change, đường dẫn artifact, task đã hoàn thành trong nhóm này, file đã chỉnh sửa):
      - `nvsx-verifier` (luôn luôn) — bao gồm annotation `← (verify: ...)` từ task đã hoàn thành
      - `nvsx-arch-verifier` (luôn luôn) — bao gồm ngôn ngữ/framework dự án
      - `nvsx-uiux-verifier` (nếu change có UI) — bao gồm danh sách file UI
      - `nvsx-test-verifier` (nếu dự án có test framework) — bao gồm lệnh test
      - Nếu verify-fixes.md tồn tại, thêm vào MỖI hướng dẫn verifier: `**Các vấn đề đã sửa trước đó (từ verify-fixes.md):**` theo sau là nội dung file
   3. Gộp báo cáo. Nếu báo cáo nào có vấn đề CRITICAL hoặc WARNING → sửa trước khi chuyển sang nhóm tiếp theo
   4. Nếu tất cả ổn → tiếp tục nhóm task tiếp theo

   Điều này ngăn lỗi tích lũy qua các nhóm task. Một bug ở nhóm 1 không được phát hiện có thể lan sang nhóm 2, 3, v.v.

   **Tạm dừng nếu:**
   - Task không rõ ràng → hỏi để làm rõ
   - Triển khai phát hiện vấn đề thiết kế → gợi ý cập nhật artifact
   - Gặp lỗi hoặc bị chặn → báo cáo và chờ hướng dẫn
   - Người dùng ngắt

   **Chèn Log**

   Mỗi task bạn triển khai BẮT BUỘC được chèn verify log. Các log này cho phép bạn xác minh tính đúng đắn từ output runtime sau khi người dùng test thủ công.

   **Quy tắc Log API:**
   - Dùng API log native của ngôn ngữ trực tiếp: `console.log` (JS/TS), `print` (Python), `error_log` (PHP), `Debug.Log` (Unity C#), `println!` (Rust), v.v.
   - Mỗi thông điệp log BẮT BUỘC bắt đầu bằng từ khóa `[VLOG]` — đây là handle tìm kiếm và xóa.
   - Đánh dấu mỗi dòng log trong source code bằng comment chứa `[VLOG]`: `// [VLOG]` (JS/TS/C#/PHP), `# [VLOG]` (Python).
   - Dọn dẹp = tìm `[VLOG]` trong codebase → xóa mọi dòng chứa nó. Một thao tác, xong.
   - Ví dụ:
     ```js
     console.log(`[VLOG][ENTER] fn=processPayment orderId=${orderId} amount=${amount}`); // [VLOG]
     ```
     ```python
     print(f"[VLOG][BRANCH] fn=apply_discount branch=loyalty tier={user.tier}")  # [VLOG]
     ```
     ```php
     error_log("[VLOG][ENTER] fn=processModule module=$module_name"); // [VLOG]
     ```
     ```csharp
     Debug.Log($"[VLOG][GAME] fn=OnCollision entity_a=player entity_b={other.tag} damage={dmg}"); // [VLOG]
     ```

   **Quy tắc định dạng — CHỈ FLAT:**
   - Định dạng: `[VLOG][TAG] fn=tên ts=<ISO> seq=<N> flow_id=<id> key=value key=value`
   - KHÔNG BAO GIỜ log object. Trích xuất 3-5 trường key dưới dạng cặp key=value flat.
   - Trích dẫn chuỗi có khoảng trắng: `name="Nguyen Van A"`
   - Mỗi dòng log phải tự chứa — đọc được mà không cần ngữ cảnh từ dòng khác.

   **Timeline & truy vết flow (BẮT BUỘC trên mỗi dòng log):**
   - `ts=` — timestamp ISO (ví dụ: `ts=2026-02-27T14:23:01.042Z`). Dùng `new Date().toISOString()` / `datetime.now().isoformat()` / `date('c')` (PHP).
   - `seq=` — số thứ tự đơn điệu tăng dần mỗi flow. Tăng counter cho mỗi dòng log trong cùng flow_id. Giải quyết xen kẽ async — dù các dòng từ flow khác nhau trộn lẫn trong file, seq= tái tạo thứ tự trong mỗi flow.
   - `flow_id=` — ID ổn định cho toàn bộ flow do người dùng khởi tạo. Định dạng: `flow-<feature>-<unique>` (ví dụ: `flow-checkout-abc123`). Tạo khi bắt đầu flow, mang theo mọi log trong flow đó.

   **Marker flow:**
   - `[FLOW]` với `event=FLOW_START` ở đầu mỗi feature flow: bao gồm `feature=`, `trigger=`, `flow_id=`
   - `[FLOW]` với `event=FLOW_END` ở cuối: bao gồm `status=`, `duration_ms=`, `steps_completed=`
   - `[HANDOFF]` khi một feature kích hoạt feature khác: bao gồm `flow_id=` (cha), `child_flow_id=` (con), `from_feature=`, `to_feature=`

   Để trích xuất toàn bộ flow của một feature từ log 50.000 dòng: `grep "flow_id=flow-checkout-abc123" app.log`

   **Hệ thống tag — chọn tag dựa trên những gì code làm:**

   Tag logic:
   - `[ENTER]` / `[EXIT]` — vào hàm với input, thoát với kết quả (mọi đường return)
   - `[BRANCH]` — nhánh điều kiện nào được chọn và tại sao: `branch=discount_applied reason=loyalty_tier`
   - `[ASSERT]` — kết quả kiểm tra bất biến: `check=amount_in_range result=true`
   - `[STATE]` — chuyển đổi state machine: `from=idle to=loading trigger=fetch_start`
   - `[EVENT]` — sự kiện hệ thống/người dùng được kích hoạt với ngữ cảnh
   - `[ASYNC:START]` / `[ASYNC:OK]` / `[ASYNC:FAIL]` / `[ASYNC:TIMEOUT]` — vòng đời async
   - `[TRANSFORM]` — thay đổi hình dạng dữ liệu: log trường input → trường output
   - `[ERROR]` — ranh giới lỗi với đầy đủ ngữ cảnh (không chỉ thông điệp)

   Tag UI/UX:
   - `[RENDER]` — mount/update component, render có điều kiện (element nào hiển thị/ẩn và tại sao), render danh sách (số item, trạng thái rỗng, phân trang), giá trị hiển thị tính toán (tiền tệ/ngày định dạng/văn bản cắt ngắn)
   - `[LAYOUT]` — hiển thị trong viewport (`in_viewport=true/false`), breakpoint responsive đang hoạt động, trạng thái overflow/scroll, kích hoạt sticky, thay đổi CSS class ảnh hưởng layout
   - `[POSITION]` — bounding rect element (`x=120 y=340 width=200 height=48`), computed styles ảnh hưởng hiển thị (`display=flex visibility=visible opacity=1.0 position=absolute z_index=100`), phát hiện chồng lấp (`element=SubmitBtn overlapped_by=CookieBanner overlap_area=100%`), kích thước element vs container (`el_width=500 container_width=400 overflows=true`), vị trí tương đối scroll (`scroll_top=320 el_offset_top=280 visible_in_scroll=true`). Dùng tag này khi vị trí, kích thước, hoặc hiển thị của element quan trọng cho tính đúng đắn.
   - `[ANIM]` — bắt đầu/kết thúc/hủy animation với duration, chuyển đổi trạng thái UI (`from=loading to=loaded`), hoán đổi skeleton→content, vòng đời toast (xuất hiện/timer/dismiss), áp dụng tùy chọn reduced motion
   - `[INTERACT]` — trạng thái hover/focus/blur, vòng đời drag&drop (start/over/drop/cancel với valid_drop), trigger scroll (infinite scroll, sticky header), hotkey (phím + action + handled), cử chỉ (long press, swipe với threshold/duration), input buffer cho game
   - `[FORM]` — thay đổi field với kết quả validation và thông báo lỗi, trạng thái form (dirty/pristine/valid/invalid + danh sách invalid_fields), lần submit (valid + blocked_by), kết quả submit (success/fail + lỗi server), thêm/xóa field động với điều kiện trigger, auto-save và timing validation debounced
   - `[NAV]` — thay đổi route (from/to/method/params), độ sâu history stack, phân giải deep link (url→resolved_route), stack modal/drawer (open/close với stack_depth), toggle tab/accordion, breadcrumb trail
   - `[A11Y]` — thay đổi thuộc tính aria (element + attr + prev/next + trigger), vào/thoát focus trap (first/last focusable), di chuyển focus (from/to/reason), thông báo screen reader (message + priority), thay đổi contrast mode và reduced motion

   Tag game:
   - `[GAME]` — trạng thái người chơi tại các frame quan trọng (`pos_x/pos_y/vel/hp/state`), sự kiện va chạm (`entity_a/entity_b/type/damage/resolution`), quyết định NPC (`decision=chase reason="player_in_radius dist=8.2"`), thay đổi tài nguyên (`resource=gold prev=150 delta=+50 new=200 reason=enemy_drop`), chuyển cảnh, kích hoạt hiệu ứng, trạng thái camera, sự kiện vật lý (`event=gravity_applied force_y=-9.8`), thay đổi điểm với multiplier/combo

   Tag reactivity:
   - `[REACTIVE]` — store dispatch (`action=ADD_TO_CART payload_id=5 prev_size=2 next_size=3`), danh sách cập nhật UI (`components_updated=CartIcon,CartDrawer`), tính toán lại computed (`name=filteredProducts prev_count=24 next_count=8`), kiểm tra đồng bộ hai chiều (`model_value="react" dom_value="react" in_sync=true`)

   Tag vòng đời tài nguyên (phát hiện memory leak):
   - `[LIFECYCLE]` — cặp create/destroy cho MỌI tài nguyên cần được dọn dẹp. Dùng `op=` với từ vựng kiểm soát:
     - `op=add` / `op=remove` — event listener
     - `op=create` / `op=clear` — timer, interval
     - `op=subscribe` / `op=unsubscribe` — observable, store, pub/sub
     - `op=mount` / `op=unmount` — component, DOM node, GameObject
     - `op=open` / `op=close` — WebSocket, kết nối HTTP, file handle
     - `op=acquire` / `op=release` — item object pool
     - `op=load` / `op=unload` — texture, asset, scene
     - Mỗi create PHẢI có trường `id=` ổn định. KHÔNG BAO GIỜ dùng tham chiếu ẩn danh — gán ID khi tạo.
     - Ví dụ: `[VLOG][LIFECYCLE] fn=ChatWindow.mount op=add event=resize id=listener-a1b2 component=ChatWindow instance=cw-007`
   - `[RESOURCE_COUNT]` — snapshot số lượng tài nguyên đang hoạt động tại các ranh giới tự nhiên (thay đổi route, chuyển cảnh, teardown test). Trường: `checkpoint=`, `active_listeners=`, `active_timers=`, `active_subscriptions=`, `mounted_components=`, `open_connections=`, `cache_entries=`
     - Ví dụ: `[VLOG][RESOURCE_COUNT] checkpoint=route-change route=/settings active_listeners=14 active_timers=3 active_subscriptions=8 mounted_components=19`
   - `[CLEANUP_AUDIT]` — phát ra khi mount VÀ unmount component. Liệt kê tất cả tài nguyên được tạo/xóa để analyzer có thể diff:
     - Mount: `phase=mount created=[listener-a1b2,timer-c3d4,sub-e5f6]`
     - Unmount: `phase=unmount removed=[listener-a1b2,timer-c3d4]` — nếu `sub-e5f6` thiếu trong removed, đó là leak.
   - `[POOL]` — trạng thái object pool game: `op=acquire/release pool=BulletPool id=bullet-001 active=23 available=27 pool_size=50`
   - `[ASSET]` — load/unload asset: `op=load/unload asset=terrain_diffuse.png id=asset-w3x4 scene=Level_03 size_kb=2048`

   **Mật độ log bắt buộc (không thể thương lượng):**

   Đây là mức tối thiểu CỨNG. "Không áp dụng" không phải lý do — nếu bạn viết code, bạn log nó.

   Mỗi hàm bạn viết hoặc chỉnh sửa:
   - 1x `[ENTER]` với tất cả input params
   - 1x `[EXIT]` trên MỌI đường return (bao gồm early return — nếu hàm có 3 return, cần 3 log `[EXIT]`)

   Mỗi điều kiện bạn viết (if/else, switch, ternary):
   - 1x `[BRANCH]` trên MỌI nhánh — không chỉ happy path. Nếu bạn viết `if/else`, CẢ HAI nhánh đều có log. Nếu bạn viết `switch` với 4 case, TẤT CẢ 4 case đều có log. Không ngoại lệ.

   Mỗi thao tác async:
   - 1x `[ASYNC:START]` trước lời gọi
   - 1x `[ASYNC:OK]` trong success handler
   - 1x `[ASYNC:FAIL]` trong error handler

   Mỗi try/catch:
   - 1x `[ERROR]` trong MỌI catch block với thông điệp lỗi + ngữ cảnh

   Mỗi UI component bạn viết hoặc chỉnh sửa:
   - 1x `[RENDER]` cho mỗi render có điều kiện (show/hide, ternary trong JSX, v-if, v.v.)
   - 1x `[RENDER]` cho giá trị hiển thị tính toán (số định dạng, ngày, văn bản cắt ngắn)
   - 1x `[POSITION]` cho element mà vị trí/kích thước/hiển thị quan trọng (modal, tooltip, dropdown, sticky header, element chồng lấp, container có thể scroll). Log bounding rect + computed styles.
   - 1x `[FORM]` cho mỗi form field change handler và mỗi trigger validation
   - 1x `[NAV]` cho mỗi thay đổi route hoặc mở/đóng modal/drawer
   - 1x `[STATE]` cho mỗi chuyển đổi state (useState setter, store dispatch, thay đổi state machine)

   Mỗi logic game bạn viết:
   - 1x `[GAME]` cho mỗi va chạm, thay đổi tài nguyên, thay đổi điểm, quyết định NPC
   - Log số học PHẢI bao gồm `prev`, `delta`, `new` để AI có thể xác minh toán học: `prev=150 delta=+50 new=200`
   - 1x `[POOL]` cho mỗi pool acquire/release với số lượng active/available

   Mỗi tài nguyên bạn tạo (event listener, timer, subscription, connection, v.v.):
   - 1x `[LIFECYCLE]` với `op=add/create/subscribe/open/acquire/load` khi tạo — với `id=` ổn định
   - 1x `[LIFECYCLE]` với `op=remove/clear/unsubscribe/close/release/unload` tương ứng trong cleanup/unmount/destroy
   - Nếu bạn thêm event listener, timer, hoặc subscription trong mount/init → BẮT BUỘC thêm remove tương ứng trong unmount/cleanup. Log CẢ HAI.

   Mỗi component có vòng đời mount/unmount:
   - 1x `[CLEANUP_AUDIT]` khi mount liệt kê tất cả tài nguyên được tạo: `phase=mount created=[id1,id2,id3]`
   - 1x `[CLEANUP_AUDIT]` khi unmount liệt kê tất cả tài nguyên được xóa: `phase=unmount removed=[id1,id2]`

   Mỗi thay đổi route / chuyển cảnh:
   - 1x `[RESOURCE_COUNT]` checkpoint với tất cả số lượng tài nguyên đang hoạt động

   Mỗi feature flow:
   - 1x `[FLOW]` với `event=FLOW_START` ở đầu
   - 1x `[FLOW]` với `event=FLOW_END` ở cuối với status và duration

   **Quy tắc chống lười:** Nếu bạn thấy mình nghĩ "nhánh này rõ ràng, không cần log" — đó CHÍNH XÁC là nhánh sẽ có bug. Log nó. Toàn bộ mục đích của lệnh này là bắt những gì "trông rõ ràng" nhưng thực ra không phải.

   **Ví dụ log:**
   ```js
   // Bắt đầu flow — tạo flow_id, khởi tạo seq counter
   let _seq = 0; // [VLOG]
   const flowId = `flow-checkout-${Date.now().toString(36)}`; // [VLOG]
   console.log(`[VLOG][FLOW] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} event=FLOW_START feature=checkout trigger=submit_click`); // [VLOG]

   // Vào hàm
   console.log(`[VLOG][ENTER] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} fn=processPayment orderId=${orderId} amount=${amount}`); // [VLOG]

   // Nhánh
   console.log(`[VLOG][BRANCH] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} fn=processPayment branch=discount_applied reason=loyalty_tier discount=0.15`); // [VLOG]

   // Vòng đời tài nguyên — tạo
   console.log(`[VLOG][LIFECYCLE] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} fn=ChatWindow.mount op=add event=resize id=listener-${instanceId} component=ChatWindow`); // [VLOG]

   // Vòng đời tài nguyên — hủy (trong cleanup)
   console.log(`[VLOG][LIFECYCLE] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} fn=ChatWindow.unmount op=remove event=resize id=listener-${instanceId} component=ChatWindow`); // [VLOG]

   // Cleanup audit
   console.log(`[VLOG][CLEANUP_AUDIT] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} fn=ChatWindow.mount phase=mount component=ChatWindow instance=${instanceId} created=[listener-${instanceId},timer-${timerId}]`); // [VLOG]

   // Resource count checkpoint
   console.log(`[VLOG][RESOURCE_COUNT] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} checkpoint=route-change route=${newRoute} active_listeners=${listenerCount} active_timers=${timerCount} active_subscriptions=${subCount}`); // [VLOG]

   // Position
   console.log(`[VLOG][POSITION] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} element=DropdownMenu x=${rect.x} y=${rect.y} width=${rect.width} height=${rect.height} z_index=${style.zIndex} overlapped_by=${overlapper || "none"}`); // [VLOG]

   // Kết thúc flow
   console.log(`[VLOG][FLOW] ts=${new Date().toISOString()} seq=${++_seq} flow_id=${flowId} event=FLOW_END feature=checkout status=success duration_ms=${Date.now() - startTime} steps_completed=${_seq}`); // [VLOG]
   ```

   Ví dụ PHP NukeViet:
   ```php
   // Bắt đầu flow
   $flow_id = 'flow-module-' . substr(md5(microtime()), 0, 8); // [VLOG]
   $seq = 0; // [VLOG]
   error_log("[VLOG][FLOW] ts=" . date('c') . " seq=" . (++$seq) . " flow_id=$flow_id event=FLOW_START feature=module_process trigger=page_load"); // [VLOG]

   // Vào hàm
   error_log("[VLOG][ENTER] ts=" . date('c') . " seq=" . (++$seq) . " flow_id=$flow_id fn=processModule module=$module_name op=$op"); // [VLOG]

   // Nhánh
   error_log("[VLOG][BRANCH] ts=" . date('c') . " seq=" . (++$seq) . " flow_id=$flow_id fn=processModule branch=admin_check result=" . (NV_IS_FILE_ADMIN ? 'true' : 'false')); // [VLOG]
   ```

7. **Khi hoàn thành hoặc tạm dừng, hiển thị trạng thái**

   Hiển thị:
   - Task đã hoàn thành trong phiên này
   - Tiến độ tổng thể: "N/M task hoàn thành"
   - Nếu tạm dừng: giải thích lý do và chờ hướng dẫn
   - Nếu tất cả xong HOẶC chỉ còn task thủ công/testing: **tiến hành auto-verify** (bước 8)

8. **Auto-Verify khi Hoàn thành**

   Khi tất cả task hoàn thành HOẶC chỉ còn task thủ công/testing, **tự động chạy xác minh**:

   ```
   ## Tất cả Task Hoàn thành — Đang Chạy Xác minh...
   ```

   Phát hiện đặc điểm change (logic tương tự bước 4 của nvsx-verify):
   - **Có UI**: quét artifact tìm từ khóa UI (component, page, modal, form, button, layout, CSS, style, responsive, animation)
   - **Có test**: dự án có test framework VÀ change chạm code có thể test

   Chạy tất cả verifier áp dụng **song song**:

   - `nvsx-verifier` (luôn luôn) — với đầy đủ ngữ cảnh artifact, ngữ cảnh triển khai, và điểm tập trung verify từ annotation task
   - `nvsx-arch-verifier` (luôn luôn) — với ngữ cảnh ngôn ngữ/framework dự án
   - `nvsx-uiux-verifier` (nếu change có UI) — với danh sách file UI
   - `nvsx-test-verifier` (nếu dự án có test framework) — với tên test framework và lệnh test

   Nếu `openspec/changes/<tên>/verify-fixes.md` tồn tại, đọc nó.

   Template hướng dẫn cho mỗi verifier:
   ```
   Xác minh triển khai cho change: <tên>

   **Artifacts:**
   - Tasks: openspec/changes/<tên>/tasks.md
   - Proposal: openspec/changes/<tên>/proposal.md
   - Design: openspec/changes/<tên>/design.md (nếu tồn tại)
   - Specs: openspec/changes/<tên>/specs/*.md (nếu tồn tại)

   **Ngữ cảnh triển khai:**
   - [task đã hoàn thành trong phiên này]
   - [file đã chỉnh sửa]

   **Các vấn đề đã sửa trước đó (từ verify-fixes.md):**
   [nội dung verify-fixes.md, hoặc "Không có" nếu file không tồn tại]
   ```

   Thêm ngữ cảnh cụ thể cho từng verifier vào mỗi hướng dẫn (điểm tập trung verify cho nvsx-verifier, file UI cho nvsx-uiux-verifier, v.v.).

   Gộp tất cả báo cáo thành kết quả xác minh thống nhất.

9. **Vòng lặp Auto-Fix**

   Sau khi nhận báo cáo xác minh, sửa **tất cả** vấn đề được báo cáo — CRITICAL, WARNING, và SUGGESTION. Không chỉ những cái dễ.

   **Sửa không cần hỏi** (không cần input người dùng):
   - CRITICAL: Task chưa hoàn thành, thiếu triển khai, chức năng bị hỏng
   - WARNING: Sai lệch spec/design, thiếu coverage scenario, test thất bại
   - SUGGESTION: Không nhất quán pattern, sai lệch code style, cải tiến nhỏ
   - Lỗi type, lỗi lint → sửa code
   - Task chưa hoàn thành nhưng thực ra đã xong → đánh dấu checkbox

   **Bỏ qua và thu thập** (thực sự cần quyết định người dùng):
   - Yêu cầu mơ hồ với nhiều cách diễn giải hợp lệ
   - Quyết định thiết kế cần xem xét lại
   - Câu hỏi về phạm vi (ranh giới tính năng không rõ)

   **Viết log sửa verify** — Sau khi sửa vấn đề, thêm vào `openspec/changes/<tên>/verify-fixes.md`. Log này ngăn re-verify trong tương lai đánh dấu lại các vấn đề đã được sửa.

   Định dạng:
   ```markdown
   ## [YYYY-MM-DD] Vòng N (từ nvsx-apply-with-log auto-verify)

   ### nvsx-verifier
   - Đã sửa: <mô tả ngữ nghĩa những gì đã sửa và ở đâu>

   ### nvsx-arch-verifier
   - Đã sửa: <mô tả ngữ nghĩa những gì đã sửa và ở đâu>
   ```

   Chỉ bao gồm các section cho verifier đã báo cáo vấn đề bạn đã sửa. Chỉ log các sửa chữa xuất phát từ kết quả verify — KHÔNG log sửa chữa từ triển khai lần đầu hoặc thay đổi do người dùng yêu cầu.

   Sau khi viết log, **re-verify TOÀN BỘ triển khai** — chạy lại tất cả verifier áp dụng **song song** trên toàn bộ change (tất cả artifact, tất cả file), không chỉ phần bạn đã sửa. Một sửa chữa ở một vùng có thể phá vỡ vùng khác. Bao gồm verify-fixes.md đã cập nhật trong mỗi hướng dẫn verifier.

   ```
   ## Đang Auto-Fix Vấn đề... (vòng 1)

   Đã sửa: [CRITICAL] Thiếu triển khai cho yêu cầu X
   Đã sửa: [WARNING] Sai lệch spec trong auth.php:45
   Đã sửa: [SUGGESTION] Không nhất quán pattern trong utils.php
   Bỏ qua: Yêu cầu mơ hồ (cần input của bạn)
   Đã ghi log sửa chữa vào verify-fixes.md

   Đang re-verify toàn bộ triển khai...
   ```

   **Lặp** — sửa → log → verify đầy đủ → sửa → log → verify đầy đủ — cho đến khi:
   - Báo cáo hiển thị 0 CRITICAL, 0 WARNING, 0 SUGGESTION
   - HOẶC chỉ còn item cần quyết định người dùng (những cái bị bỏ qua)

   Mỗi vòng dùng cùng xác minh song song đầy đủ từ bước 8 (tất cả verifier áp dụng, tất cả artifact, tất cả ngữ cảnh, tất cả vấn đề đã sửa trước đó). Không có lối tắt.

10. **Output Cuối (Code Verify Pass)**

    Sau khi vòng lặp auto-fix hoàn thành, hiển thị trạng thái nhưng CHƯA gợi ý archive. Log vẫn còn trong code.

    ```
    ## Triển khai Hoàn thành — Code Đã Xác minh

    **Change:** <tên-change>
    **Tiến độ:** 7/7 task hoàn thành
    **Xác minh tĩnh:** Tất cả kiểm tra đã qua
    **Verify log:** Đã chèn

    Bây giờ tôi cần bạn test thủ công toàn bộ flow và gửi cho tôi runtime log.
    ```

    Cung cấp hướng dẫn rõ ràng cho người dùng:
    - Flow nào cần test (liệt kê từng user flow lớn từ các task)
    - Cách capture log (copy từ browser console / terminal output / lưu vào file)
    - Nếu output log lớn, gợi ý lưu vào file và chia sẻ đường dẫn file

11. **Xác minh Dựa trên Log (BẮT BUỘC)**

    Bước này là điều làm `nvsx-apply-with-log` khác với `nvsx-apply`. Bạn xác minh tính đúng đắn từ hành vi runtime thực tế, không chỉ phân tích code tĩnh.

    **Khi người dùng cung cấp log**, ủy thác phân tích cho subagent `nvsx-log-analyzer`. KHÔNG tự phân tích log — subagent có ngữ cảnh sạch và chiến lược multi-pass có cấu trúc được tối ưu cho file lớn.

    **Chạy subagent `nvsx-log-analyzer`** với các hướng dẫn sau:

    ```
    Phân tích runtime log cho change: <tên>

    **File log:** <đường dẫn do người dùng cung cấp>
    **Dev mode:** <true/false — hỏi người dùng nếu không rõ>

    **Artifacts (cho hành vi mong đợi):**
    - Tasks: openspec/changes/<tên>/tasks.md
    - Proposal: openspec/changes/<tên>/proposal.md
    - Design: openspec/changes/<tên>/design.md (nếu tồn tại)

    **File đã chỉnh sửa:** [danh sách file source đã triển khai trong phiên này]

    **Flow mong đợi:** [liệt kê user flow lớn từ task, ví dụ: "checkout flow", "login flow"]
    **Tiền tố flow ID:** [ví dụ: flow-checkout-, flow-login-]
    **Dọn dẹp tài nguyên mong đợi:** [loại LIFECYCLE đã dùng: LISTENER, TIMER, SUBSCRIPTION, CONNECTION, v.v.]

    Chạy tất cả 3 pass: flow completeness, memory leak detection, correctness.
    ```

    **Sau khi nhận báo cáo**, hành động theo kết quả:

    **Nếu thiếu log coverage** (flow chưa đầy đủ, nhánh chưa được test):
    ```
    ## Thiếu Log Coverage

    Các flow này chưa được bao phủ trong log bạn cung cấp:

    1. [mô tả flow] — cần test: [hành động cụ thể]
    2. [mô tả flow] — nhánh [X] chưa được thực hiện, cần test: [điều kiện kích hoạt nó]

    Vui lòng test các flow này và gửi lại log cho tôi.
    ```

    **Nếu tìm thấy bug hoặc memory leak:**
    ```
    ## Vấn đề Tìm thấy trong Runtime Log

    1. [CRITICAL] [mô tả] — bằng chứng: [trích đoạn log từ báo cáo]
    2. [HIGH] Memory leak: [tài nguyên] được tạo nhưng không bao giờ bị hủy
    3. [MEDIUM] Resource count tăng dần: active_listeners 14 → 16 → 18 → 21

    Đang sửa...
    ```

    Sửa các vấn đề. Thêm log `[VLOG]` bổ sung nếu sửa chữa giới thiệu đường logic mới hoặc tài nguyên mới cần theo dõi vòng đời. Sau đó yêu cầu người dùng test thủ công lại và cung cấp log mới.

    **Lặp** — người dùng cung cấp log → ủy thác cho `nvsx-log-analyzer` → sửa vấn đề + thêm log → người dùng retest → cho đến khi:
    - Tất cả flow hoàn thành (mọi FLOW_START có FLOW_END)
    - Không có memory leak (mọi create có matching destroy, resource count ổn định)
    - Tất cả nhánh được bao phủ
    - Không có lỗi bất ngờ
    - Tất cả số học đúng
    - Tất cả kiểm tra position/layout qua

12. **Dọn dẹp Log**

    Khi xác minh log hoàn toàn sạch, hỏi người dùng xác nhận:

    ```
    ## Xác minh Log Hoàn thành

    Tất cả kiểm tra runtime đã qua. Không tìm thấy vấn đề.

    Sẵn sàng xóa tất cả verify log khỏi code?
    ```

    **Khi người dùng xác nhận:**
    - Xóa tất cả dòng chứa `[VLOG]` trong source code (cả lời gọi log và comment marker `// [VLOG]` đều trên cùng một dòng, nên một thao tác tìm kiếm-xóa xử lý được)
    - Xác minh code vẫn compile/chạy sau khi dọn dẹp (không có xóa nhầm)

    **Sau khi dọn dẹp, hiển thị output cuối:**

    ```
    ## Triển khai Hoàn thành & Đã Xác minh (với runtime log)

    **Change:** <tên-change>
    **Tiến độ:** 7/7 task hoàn thành
    **Xác minh tĩnh:** Đã qua
    **Xác minh log runtime:** Đã qua ([N] flow đã xác minh, [M] nhánh đã bao phủ)
    **Log đã dọn:** Xong

    Sẵn sàng archive → `/nvsx-archive <tên>`
    ```

    **Nếu còn vấn đề thủ công:**
    ```
    ## Triển khai Hoàn thành (Còn Vấn đề Thủ công)

    **Change:** <tên-change>
    **Tiến độ:** 7/7 task hoàn thành
    **Xác minh tĩnh:** Đã qua
    **Xác minh log runtime:** Đã qua
    **Log đã dọn:** Xong
    **Còn lại:** [M] vấn đề thủ công

    ### Vấn đề Cần Quyết định của Bạn:
    1. [vấn đề] — [các lựa chọn]
    2. [vấn đề] — [các lựa chọn]

    Sau khi giải quyết, chạy `/nvsx-verify` lại hoặc tiến hành archive.
    ```

13. **Tư thế Tinh chỉnh (khi người dùng yêu cầu sửa hoặc cải thiện code bạn đã viết)**

    Khi người dùng quay lại với "cái này không hoạt động", "sửa cái này", "tinh chỉnh cái này", hoặc chỉ ra vấn đề với code bạn đã triển khai:

    **Khám phá lại trước khi vá** — KHÔNG chỉnh sửa code bạn đã viết ngay lập tức. Trước tiên:
    - Đọc lại các vùng codebase liên quan (không chỉ các thay đổi trước đó của bạn)
    - Hiểu hành vi thực tế so với hành vi mong đợi
    - Theo dõi luồng thực thi để tìm nguyên nhân thực sự

    **Chẩn đoán nguyên nhân gốc, không phải triệu chứng** — Tự hỏi:
    - Vấn đề có trong code CỦA TÔI, hay trong cách code của tôi tương tác với code hiện có?
    - Cách tiếp cận có sai về cơ bản, hay chỉ là lỗi nhỏ?
    - Nếu tôi vá chỗ này, liệu cùng loại vấn đề có xuất hiện ở nơi khác không?

    **Viết lại thay vì vá** — Nếu nguyên nhân gốc là cách tiếp cận sai:
    - KHÔNG thêm workaround hoặc band-aid lên code hiện có
    - Viết lại phần bị ảnh hưởng từ đầu với cách tiếp cận đúng
    - Rẻ hơn khi viết lại 50 dòng đúng cách hơn là vá 5 dòng tạo ra 3 bug nữa

    **Phá vỡ vòng lặp an toàn** — Bạn có quyền:
    - Xóa code bạn đã viết trong phiên này và bắt đầu lại
    - Thay đổi cách tiếp cận hoàn toàn nếu bằng chứng cho thấy nó sai
    - Không đồng ý với plan ban đầu nếu triển khai cho thấy nó có lỗi
    - Gợi ý cập nhật artifact (design.md, tasks.md) để phản ánh cách tiếp cận tốt hơn

**Output Trong Quá trình Triển khai**

```
## Đang Triển khai: <tên-change> (schema: <tên-schema>)

Đang làm task 3/7: <mô tả task>
[...đang triển khai...]
Task hoàn thành

Đang làm task 4/7: <mô tả task>
[...đang triển khai...]
Task hoàn thành
```

**Output Khi Tạm dừng (Gặp Vấn đề)**

```
## Triển khai Tạm dừng

**Change:** <tên-change>
**Schema:** <tên-schema>
**Tiến độ:** 4/7 task hoàn thành

### Vấn đề Gặp phải
<mô tả vấn đề>

**Các lựa chọn:**
1. <lựa chọn 1>
2. <lựa chọn 2>
3. Cách tiếp cận khác

Bạn muốn làm gì?
```

**Guardrails**
- Tiếp tục qua các task cho đến khi xong hoặc bị chặn
- Luôn đọc file ngữ cảnh trước khi bắt đầu (từ output hướng dẫn apply)
- Nếu task mơ hồ, tạm dừng và hỏi trước khi triển khai
- Nếu triển khai phát hiện vấn đề, tạm dừng và gợi ý cập nhật artifact
- Giữ thay đổi code tối thiểu và tập trung vào từng task — nhưng khi tinh chỉnh, ưu tiên viết lại hơn vá nếu nguyên nhân gốc đòi hỏi
- **Theo dõi task real-time** — Đánh dấu mỗi task `[x]` NGAY KHI xong. Không bao giờ gộp cập nhật checkbox.
- **Cổng verify milestone** — Trước khi bắt đầu nhóm task lớn mới (ví dụ: chuyển từ task 1.x sang 2.x), BẮT BUỘC chạy tất cả verifier áp dụng song song và sửa mọi vấn đề CRITICAL/WARNING trước.
- Tạm dừng khi gặp lỗi, bị chặn, hoặc yêu cầu không rõ - không đoán mò
- Dùng contextFiles từ output CLI, không giả định tên file cụ thể
- **Auto-verify khi hoàn thành** — BẮT BUỘC chạy tất cả verifier áp dụng song song khi tất cả task AI-doable hoàn thành (kể cả khi còn task thủ công/testing). Luôn luôn: nvsx-verifier + nvsx-arch-verifier. Có điều kiện: nvsx-uiux-verifier (thay đổi UI), nvsx-test-verifier (dự án có test).
- **Auto-fix TẤT CẢ vấn đề** — sửa CRITICAL, WARNING, và SUGGESTION. Chỉ bỏ qua item thực sự cần quyết định người dùng.
- **Vòng lặp re-verify đầy đủ** — sau khi sửa, re-verify TOÀN BỘ triển khai (không chỉ phần đã sửa). Lặp cho đến khi báo cáo sạch hoặc chỉ còn item cần quyết định người dùng.
- **Log sửa verify** — sau khi sửa vấn đề từ kết quả verify, BẮT BUỘC thêm vào `verify-fixes.md` trong thư mục change. Nhóm theo verifier, dùng mô tả ngữ nghĩa. Điều này ngăn re-verify đánh dấu lại vấn đề đã sửa. Luôn truyền nội dung verify-fixes.md cho verifier.
- **Chèn log `[VLOG]` cho mỗi task** — không có task nào hoàn thành mà không có verify log bao phủ logic và đường UI. Dùng hệ thống tag và native log API.
- **Log CHỈ FLAT** — trích xuất trường key dưới dạng key=value, KHÔNG BAO GIỜ log object hoặc JSON.stringify.
- **Mỗi dòng log có `[VLOG]` trong cả message và comment source** — message bắt đầu bằng `[VLOG][TAG]`, dòng source kết thúc bằng `// [VLOG]`. Đây là cleanup handle.
- **Hiển thị tóm tắt log trước khi đánh dấu task hoàn thành** — đếm lần gọi `[VLOG]` theo tag, hiển thị tóm tắt. Nếu số lượng thấp, quay lại và thêm log còn thiếu.
- **Mật độ log bắt buộc** — 1 ENTER + 1 EXIT mỗi hàm, 1 BRANCH mỗi nhánh điều kiện (TẤT CẢ nhánh, không chỉ happy path), 1 ASYNC mỗi thao tác async, 1 ERROR mỗi catch, 1 RENDER mỗi render có điều kiện, 1 POSITION cho element quan trọng về layout, 1 FORM mỗi field handler. Đây là mức tối thiểu cứng.
- **Chống lười: log nhánh "rõ ràng"** — nếu nhánh "trông rõ ràng", log nó dù sao. Nhánh rõ ràng là nơi bug ẩn náu.
- **Mỗi tài nguyên được tạo PHẢI có log destroy tương ứng** — nếu bạn thêm event listener, timer, subscription, hoặc connection, log cả create VÀ cleanup. Không có create mà không có destroy.
- **CLEANUP_AUDIT tại mỗi mount/unmount** — liệt kê những gì được tạo, liệt kê những gì được xóa. Analyzer diff những cái này.
- **RESOURCE_COUNT tại mỗi thay đổi route / chuyển cảnh** — snapshot số lượng đang hoạt động để analyzer có thể phát hiện xu hướng tăng.
- **Timeline trên mỗi dòng log** — ts=, seq=, flow_id= là BẮT BUỘC. Không có những cái này, analyzer không thể theo dõi flow trong file lớn.
- **FLOW_START và FLOW_END cho mỗi feature flow** — analyzer kiểm tra mọi start có matching end.
- **Ủy thác phân tích log cho nvsx-log-analyzer** — KHÔNG tự phân tích log. Subagent có ngữ cảnh sạch và chiến lược multi-pass có cấu trúc.
- **Verify dựa trên log là BẮT BUỘC** — sau khi xác minh tĩnh qua, người dùng BẮT BUỘC test thủ công và cung cấp runtime log trước khi dọn dẹp.
- **Thiếu log coverage → yêu cầu retest** — nếu log không bao phủ tất cả nhánh/flow, yêu cầu người dùng test các flow còn thiếu cụ thể.

**Tích hợp Workflow Linh hoạt**

Skill này hỗ trợ mô hình "actions on a change":

- **Có thể gọi bất cứ lúc nào**: Trước khi tất cả artifact xong (nếu task tồn tại), sau khi triển khai một phần, xen kẽ với các action khác
- **Cho phép cập nhật artifact**: Nếu triển khai phát hiện vấn đề thiết kế, gợi ý cập nhật artifact - không bị khóa theo phase, làm việc linh hoạt
- **Auto-verify khi hoàn thành**: Khi tất cả task xong, tự động verify và sửa vấn đề

**Tham chiếu Subagent**

| Subagent | Mục đích |
|----------|---------|
| `nvsx-verifier` | Xác minh độc lập triển khai (ngữ cảnh sạch) |
| `nvsx-arch-verifier` | Kiến trúc, design pattern, thay thế thư viện |
| `nvsx-uiux-verifier` | Xác minh chất lượng UI/UX (khi change có UI) |
| `nvsx-test-verifier` | Xác minh test coverage và chất lượng (khi dự án có test) |
| `nvsx-log-analyzer` | Phân tích file runtime log lớn cho tính đúng đắn, memory leak, và flow completeness |
| `nvsx-doc-lookup` | Tra cứu tài liệu API/hàm — signature chính xác, params, hành vi theo phiên bản |

**Gợi ý Chuyển đổi Mode**

Sau khi triển khai hoàn thành (với xác minh) hoặc tạm dừng:

- Để suy nghĩ/khám phá/brainstorm → `/nvsx-plan`
- Để tạo change mới → `/nvsx-ff`
- Để re-verify thủ công → `/nvsx-verify`
- Để archive công việc đã hoàn thành → `/nvsx-archive`

**QUAN TRỌNG**: Sau khi lệnh này kết thúc, KHÔNG tự động tiếp tục viết code trên các tin nhắn người dùng tiếp theo trừ khi người dùng yêu cầu rõ ràng tiếp tục triển khai hoặc gọi `/nvsx-apply-with-log` lại. Nếu người dùng gọi `/nvsx-plan`, BẮT BUỘC chuyển hoàn toàn sang chế độ khám phá — không viết code. Nếu người dùng gọi `/nvsx-ff`, BẮT BUỘC chuyển hoàn toàn sang chế độ tạo change — không viết code, không tiếp tục task.

Nội dung sau đây là yêu cầu của người dùng:
