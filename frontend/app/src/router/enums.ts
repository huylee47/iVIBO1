// 完整版菜单比较多，将 rank 抽离出来，在此方便维护
// Phiên bản đầy đủ có nhiều menu hơn, và thứ hạng được trích ra để thuận tiện cho việc bảo trì tại đây.
// Nền tảng quy định rằng chỉ thứ hạng của tuyến đường về nhà mới có thể là 0, do đó phần phụ trợ cần bắt đầu từ khác 0 khi trả về thứ hạng.
// 平台规定只有 home 路由的 rank 才能为 0 ，所以后端在返回 rank 的时候需要从非 0 开始
const home = 0,
  checkin = 1, // Đưa checkin lên vị trí đầu tiên
  vueflow = 2,
  ganttastic = 3,
  components = 4,
  able = 5,
  table = 6,
  form = 7,
  list = 8,
  result = 9,
  error = 10,
  frame = 11,
  nested = 12,
  permission = 13,
  system = 14,
  monitor = 15,
  tabs = 16,
  about = 17,
  editor = 18,
  flowchart = 19,
  formdesign = 20,
  board = 21,
  ppt = 22,
  mind = 23,
  guide = 24,
  menuoverflow = 25; // Đẩy menuoverflow xuống cuối

export {
  home,
  checkin, // Đảm bảo checkin được export chính xác
  vueflow,
  ganttastic,
  components,
  able,
  table,
  form,
  list,
  result,
  error,
  frame,
  nested,
  permission,
  system,
  monitor,
  tabs,
  about,
  editor,
  flowchart,
  formdesign,
  board,
  ppt,
  mind,
  guide,
  menuoverflow
};
