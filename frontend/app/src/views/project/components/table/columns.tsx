import {delay} from "@pureadmin/utils";
import {ref, onMounted, reactive} from "vue";
import type {PaginationProps} from "@pureadmin/table";
import Empty from "./empty.svg?component";
import {apiClient} from "@/api/api";

export function useColumns() {
  const dataList = ref([]);
  const loading = ref(true);
  const columns = [
    {
      sortable: true,
      label: "ID",
      prop: "id",
    },
    {
      sortable: true,
      label: "Project Name",
      prop: "project_name",
    },
    {
      sortable: true,
      label: "Status",
      prop: "project_status",
    },
    {
      sortable: true,
      label: "Status ID",
      prop: "status_id",
    },
    {
      sortable: true,
      label: "Created At",
      prop: "created_at",
      cellRenderer: ({row}) => (
        <div>{new Date(row.created_at).toLocaleDateString()}</div>
      ),
    },
    {
      label: "Actions",
      fixed: "right",
      slot: "operation",
    },
  ];

  const pagination = reactive<PaginationProps>({
    pageSize: 10,
    currentPage: 1,
    layout: "prev, pager, next",
    total: 0,
    align: "center",
  });

  function onCurrentChange(page: number) {
    console.log("onCurrentChange", page);
    loading.value = true;
    delay(300).then(() => {
      loading.value = false;
    });
  }

  const loadProjects = async () => {
    const response =  await apiClient.get("/api/project");
    return response.data;
  }

  onMounted( async () => {
    dataList.value = [];
    const projects = await loadProjects();
    dataList.value = projects;
    pagination.total = dataList.value.length;
    loading.value = false;
  });

  return {
    Empty,
    loading,
    columns,
    dataList,
    pagination,
    onCurrentChange,
  };
}
