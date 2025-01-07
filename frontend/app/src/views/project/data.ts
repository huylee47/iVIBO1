import { dayjs, cloneDeep, getRandomIntBetween } from "./utils";
import GroupLine from "@iconify-icons/ri/group-line";
import Question from "@iconify-icons/ri/question-answer-line";
import CheckLine from "@iconify-icons/ri/chat-check-line";
import Smile from "@iconify-icons/ri/star-smile-line";

const days = ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 5", "Thứ 7"];

/** Nhân sự、Phản hồi、Hoàn thành、Đánh giá người dùng */
const chartData = [
  {
    icon: GroupLine,
    bgColor: "#effaff",
    color: "#41b6ff",
    duration: 2200,
    name: "Nhân sự",
    value: 36000,
    percent: "+88%",
    data: [2101, 5288, 4239, 4962, 6752, 5208, 7450] // 平滑折线图数据
  },
  {
    icon: Question,
    bgColor: "#fff5f4",
    color: "#e85f33",
    duration: 1600,
    name: "Phản hồi",
    value: 16580,
    percent: "+70%",
    data: [2216, 1148, 1255, 788, 4821, 1973, 4379]
  },
  {
    icon: CheckLine,
    bgColor: "#eff8f4",
    color: "#26ce83",
    duration: 1500,
    name: "Hoàn thành",
    value: 16499,
    percent: "+99%",
    data: [861, 1002, 3195, 1715, 3666, 2415, 3645]
  },
  {
    icon: Smile,
    bgColor: "#f6f4fe",
    color: "#7846e5",
    duration: 100,
    name: "Đánh giá người dùng",
    value: 100,
    percent: "+100%",
    data: [100]
  }
];

/** Thống kê */
const barChartData = [
  {
    requireData: [2101, 5288, 4239, 4962, 6752, 5208, 7450],
    questionData: [2216, 1148, 1255, 1788, 4821, 1973, 4379]
  },
  {
    requireData: [2101, 3280, 4400, 4962, 5752, 6889, 7600],
    questionData: [2116, 3148, 3255, 3788, 4821, 4970, 5390]
  }
];

/** Tiến độ  */
const progressData = [
  {
    week: "Thứ 2",
    percentage: 85,
    duration: 110,
    color: "#41b6ff"
  },
  {
    week: "Thứ 3",
    percentage: 86,
    duration: 105,
    color: "#41b6ff"
  },
  {
    week: "Thứ 4",
    percentage: 88,
    duration: 100,
    color: "#41b6ff"
  },
  {
    week: "Thứ 5",
    percentage: 89,
    duration: 95,
    color: "#41b6ff"
  },
  {
    week: "Thứ 6",
    percentage: 94,
    duration: 90,
    color: "#26ce83"
  },
  {
    week: "Thứ 7",
    percentage: 96,
    duration: 85,
    color: "#26ce83"
  },
  {
    week: "Chủ nhật",
    percentage: 100,
    duration: 80,
    color: "#26ce83"
  }
].reverse();

/** Thống kê bảng */
const tableData = Array.from({ length: 30 }).map((_, index) => {
  return {
    id: index + 1,
    requiredNumber: getRandomIntBetween(13500, 19999),
    questionNumber: getRandomIntBetween(12600, 16999),
    resolveNumber: getRandomIntBetween(13500, 17999),
    satisfaction: getRandomIntBetween(95, 100),
    date: dayjs().subtract(index, "day").format("YYYY-MM-DD")
  };
});

/** Tin mới */
const latestNewsData = cloneDeep(tableData)
  .slice(0, 14)
  .map((item, index) => {
    return Object.assign(item, {
      name:"Nguyen Thi A",
      date: `${dayjs().subtract(index, "day").format("YYYY-MM-DD")} ${
        days[dayjs().subtract(index, "day").day()]
      }`
    });
  });

export { chartData, barChartData, progressData, tableData, latestNewsData };
