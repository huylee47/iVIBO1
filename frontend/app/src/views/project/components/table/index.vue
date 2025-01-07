<template>
  <div class="text-center d-flex justify-content align-center">
    <pure-table
      row-key="id"
      alignWhole="center"
      showOverflowTooltip
      :loading="loading"
      :loading-config="{ background: 'transparent' }"
      :data="
      dataList.slice(
        (pagination.currentPage - 1) * pagination.pageSize,
        pagination.currentPage * pagination.pageSize
      )
    "
      :columns="columns"
      :pagination="pagination"
      @page-current-change="onCurrentChange"
    >
      <template #empty>
        <el-empty description="" :image-size="60">
          <template #image>
            <Empty/>
          </template>
        </el-empty>
      </template>
      <template #operation="{ row }">
        <a>
          <el-button
            @click="getProjectById(row.id)"
            plain
            circle
            size="small"
            :title="`Chi tiết dự án ${row.id}`"
            :icon="useRenderIcon('ri:search-line')"
          />
        </a>

      </template>
    </pure-table>
  </div>

</template>
<script setup lang="ts">
import {useColumns} from "./columns";
import {useRenderIcon} from "@/components/ReIcon/src/hooks";
import {apiClient} from "@/api/api";
import {ref} from "vue";
const emit = defineEmits(["project"]);


const getProjectById= async(id)=>{
  const response = await apiClient.get(`/api/project?id[eq]=${id}`);
  console.log(response);
  if(response.status==200){
    emit("project",response.data[0]);
  }
}

const {loading, columns, dataList, pagination, Empty, onCurrentChange} = useColumns();

</script>
<style lang="scss">
.pure-table-filter {
  .el-table-filter__list {
    min-width: 80px;
    padding: 0;

    li {
      line-height: 28px;
    }
  }
}
</style>
<style lang="scss" scoped>
:deep(.el-table) {
  --el-table-border: none;
  --el-table-border-color: transparent;

  .el-empty__description {
    margin: 0;
  }

  .el-scrollbar__bar {
    display: none;
  }
}
</style>
