<script setup lang="tsx">
import { h, ref, watch } from "vue";
import { message } from "@/utils/message";
import HomeFilled from "@iconify-icons/ep/home-filled";
import { useRenderIcon } from "@/components/ReIcon/src/hooks";
import Segmented, { type OptionsType } from "@/components/ReSegmented";

defineOptions({
  name: "Segmented"
});

/** 基础用法 */
const value = ref(4); // 必须为number类型
const size = ref("default");
const dynamicSize = ref();

const optionsBasis: Array<OptionsType> = [
  {
    label: "Thứ 2"
  },
  {
    label: "thứ 3"
  },
  {
    label: "Thứ 4"
  },
  {
    label: "Thứ 5"
  },
  {
    label: "Thứ 6"
  }
];

/** tooltip 提示 */
const optionsTooltip: Array<OptionsType> = [
  {
    label: "Thứ 2",
    tip: "Thứ 2启航，新的篇章"
  },
  {
    label: "Thứ 3",
    tip: "Thứ 3律动，携手共进"
  },
  {
    label: "Thứ 4",
    tip: "Thứ 4昂扬，激情不减"
  },
  {
    label: "Thứ 5",
    tip: "Thứ 5精进，事半功倍"
  },
  {
    label: "Thứ 6",
    tip: "Thứ 6喜悦，收尾归档"
  }
];

/** 禁用 */
const optionsDisabled: Array<OptionsType> = [
  {
    label: "Thứ 2"
  },
  {
    label: "Thứ 3"
  },
  {
    label: "Thứ 4",
    disabled: true
  },
  {
    label: "Thứ 5"
  },
  {
    label: "Thứ 6",
    disabled: true
  }
];

/** block */
const optionsBlock: Array<OptionsType> = [
  {
    label: "Thứ 2"
  },
  {
    label: "Thứ 3"
  },
  {
    label: "Thứ 4"
  },
  {
    label: "Thứ 5"
  },
  {
    label: "Thứ 6喜悦，收尾归档，周末倒计时",
    tip: "Thứ 6喜悦，收尾归档，周末倒计时"
  }
];

/** 可设置图标 */
const optionsIcon: Array<OptionsType> = [
  {
    label: "Thứ 2",
    icon: HomeFilled
  },
  {
    label: "Thứ 3"
  },
  {
    label: "Thứ 4",
    icon: "ri:terminal-window-line"
  },
  {
    label: "Thứ 5"
  },
  {
    label: "Thứ 6",
    icon: "streamline-emojis:2"
  }
];

/** 只设置图标 */
const optionsOnlyIcon: Array<OptionsType> = [
  {
    icon: HomeFilled
  },
  {
    icon: "ri:terminal-window-line"
  },
  {
    icon: "streamline-emojis:cow-face"
  },
  {
    icon: "streamline-emojis:airplane"
  },
  {
    icon: "streamline-emojis:2"
  }
];

/** 自定义渲染 */
const optionsLabel: Array<OptionsType> = [
  {
    label: () => (
      <div>
        {h(useRenderIcon(HomeFilled), {
          class: "m-auto mt-1 w-[18px] h-[18px]"
        })}
        <p>Thứ 2</p>
      </div>
    )
  },
  {
    label: () => (
      <div>
        {h(useRenderIcon("ri:terminal-window-line"), {
          class: "m-auto mt-1 w-[18px] h-[18px]"
        })}
        <p>Thứ 3</p>
      </div>
    )
  },
  {
    label: () => (
      <div>
        {h(useRenderIcon("streamline-emojis:cow-face"), {
          class: "m-auto mt-1 w-[18px] h-[18px]"
        })}
        <p>Thứ 4</p>
      </div>
    )
  }
];

const optionsChange: Array<OptionsType> = [
  {
    label: "Thứ 2",
    value: 1
  },
  {
    label: "Thứ 3",
    value: 2
  },
  {
    label: "Thứ 4",
    value: 3
  }
];

/** change 事件 */
function onChange({ index, option }) {
  const { label, value } = option;
  message(`当前选中项索引为：${index}，名字为${label}，值为${value}`, {
    type: "success"
  });
}

watch(size, val => (dynamicSize.value = size.value));
</script>

<template>
  <el-card shadow="never">
    <template #header>
      <div class="card-header">
        <el-space wrap :size="40">
          <span style="font-size: 16px; font-weight: 800"> 分段控制器 </span>
          <el-radio-group v-model="size">
            <el-radio value="large">大尺寸</el-radio>
            <el-radio value="default">默认尺寸</el-radio>
            <el-radio value="small">小尺寸</el-radio>
          </el-radio-group>
        </el-space>
      </div>
      <el-link
        class="mt-2"
        href="https://github.com/pure-admin/vue-pure-admin/blob/main/src/views/components/segmented.vue"
        target="_blank"
      >
        代码位置 src/views/components/segmented.vue
      </el-link>
    </template>
    <el-scrollbar>
      <p class="mb-2">
        基础用法（v-model）<span class="text-primary">
          {{ optionsBasis[value].label }}
        </span>
      </p>
      <Segmented v-model="value" :options="optionsBasis" :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">tooltip 提示</p>
      <Segmented :options="optionsTooltip" :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">change 事件</p>
      <Segmented
        :options="optionsChange"
        :size="dynamicSize"
        @change="onChange"
      />
      <el-divider />
      <p class="mb-2">禁用</p>
      <Segmented :options="optionsDisabled" :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">全局禁用</p>
      <Segmented :options="optionsBasis" :size="dynamicSize" disabled />
      <el-divider />
      <p class="mb-2">block 属性(将宽度调整为父元素宽度)</p>
      <Segmented :options="optionsBlock" block :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">可设置图标</p>
      <Segmented :options="optionsIcon" :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">只设置图标</p>
      <Segmented :options="optionsOnlyIcon" :size="dynamicSize" />
      <el-divider />
      <p class="mb-2">自定义渲染</p>
      <Segmented :options="optionsLabel" :size="dynamicSize" />
    </el-scrollbar>
  </el-card>
</template>

<style scoped>
:deep(.el-divider--horizontal) {
  margin: 17px 0;
}
</style>
