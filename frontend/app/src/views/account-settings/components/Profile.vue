<script setup lang="ts">
import { reactive, ref } from "vue";
import { formUpload } from "@/api/mock";
import { message } from "@/utils/message";
import { type UserInfo, getMine } from "@/api/user";
import type { FormInstance, FormRules } from "element-plus";
import ReCropperPreview from "@/components/ReCropperPreview";
import { createFormData, deviceDetection } from "@pureadmin/utils";
import uploadLine from "@iconify-icons/ri/upload-line";

defineOptions({
  name: "Profile"
});

const imgSrc = ref("");
const cropperBlob = ref();
const cropRef = ref();
const uploadRef = ref();
const isShow = ref(false);
const userInfoFormRef = ref<FormInstance>();

const userInfos = reactive({
  avatar: "",
  nickname: "",
  email: "",
  phone: "",
  description: ""
});

const rules = reactive<FormRules<UserInfo>>({
  nickname: [{ required: true, message: "Tên必填", trigger: "blur" }]
});

function queryEmail(queryString, callback) {
  const emailList = [
    { value: "@qq.com" },
    { value: "@126.com" },
    { value: "@163.com" }
  ];
  let results = [];
  let queryList = [];
  emailList.map(item =>
    queryList.push({ value: queryString.split("@")[0] + item.value })
  );
  results = queryString
    ? queryList.filter(
        item =>
          item.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0
      )
    : queryList;
  callback(results);
}

const onChange = uploadFile => {
  const reader = new FileReader();
  reader.onload = e => {
    imgSrc.value = e.target.result as string;
    isShow.value = true;
  };
  reader.readAsDataURL(uploadFile.raw);
};

const handleClose = () => {
  cropRef.value.hidePopover();
  uploadRef.value.clearFiles();
  isShow.value = false;
};

const onCropper = ({ blob }) => (cropperBlob.value = blob);

const handleSubmitImage = () => {
  const formData = createFormData({
    files: new File([cropperBlob.value], "avatar")
  });
  formUpload(formData)
    .then(({ success, data }) => {
      if (success) {
        message("Tải thành công", { type: "success" });
        handleClose();
      } else {
        message("Tải thất bại");
      }
    })
    .catch(error => {
      message(`có lỗi xảy ra ${error}`, { type: "error" });
    });
};

// 更新信息
const onSubmit = async (formEl: FormInstance) => {
  await formEl.validate((valid, fields) => {
    if (valid) {
      console.log(userInfos);
      // 更新信息成功
      message("Cập nhật thông tin thành công", { type: "success" });
    } else {
      console.log("error submit!", fields);
    }
  });
};

getMine().then(res => {
  Object.assign(userInfos, res.data);
});
</script>

<template>
  <div
    :class="[
      'min-w-[180px]',
      deviceDetection() ? 'max-w-[100%]' : 'max-w-[70%]'
    ]"
  >
    <h3 class="my-8">Thông tin cá nhân</h3>
    <el-form
      ref="userInfoFormRef"
      label-position="top"
      :rules="rules"
      :model="userInfos"
    >
      <el-form-item label="Ảnh đại diện">
        <el-avatar :size="80" :src="userInfos.avatar" />
        <el-upload
          ref="uploadRef"
          accept="image/*"
          action="#"
          :limit="1"
          :auto-upload="false"
          :show-file-list="false"
          :on-change="onChange"
        >
          <el-button plain class="ml-4">
            <IconifyIconOffline :icon="uploadLine" />
            <span class="ml-2">Tải ảnh lên</span>
          </el-button>
        </el-upload>
      </el-form-item>
      <el-form-item label="Tên" prop="nickname">
        <el-input v-model="userInfos.nickname" placeholder="请输入Tên" />
      </el-form-item>
      <el-form-item label="E-mail" prop="email">
        <el-autocomplete
          v-model="userInfos.email"
          :fetch-suggestions="queryEmail"
          :trigger-on-focus="false"
          placeholder="请输入E-mail"
          clearable
          class="w-full"
        />
      </el-form-item>
      <el-form-item label="Số điện thoại">
        <el-input
          v-model="userInfos.phone"
          placeholder="请输入Số điện thoại"
          clearable
        />
      </el-form-item>
      <el-form-item label="Giới thiệu">
        <el-input
          v-model="userInfos.description"
          placeholder="请输入Giới thiệu"
          type="textarea"
          :autosize="{ minRows: 6, maxRows: 8 }"
          maxlength="56"
          show-word-limit
        />
      </el-form-item>
      <el-button type="primary" @click="onSubmit(userInfoFormRef)">
        <!-- 更新信息 -->
        Cập nhật thông tin
      </el-button>
    </el-form>
    <el-dialog
      v-model="isShow"
      width="40%"
      title="Ảnh đại diện"
      destroy-on-close
      :closeOnClickModal="false"
      :before-close="handleClose"
      :fullscreen="deviceDetection()"
    >
      <ReCropperPreview ref="cropRef" :imgSrc="imgSrc" @cropper="onCropper" />
      <template #footer>
        <div class="dialog-footer">
          <el-button bg text @click="handleClose">Huỷ</el-button>
          <el-button bg text type="primary" @click="handleSubmitImage">
            Xác nhận
          </el-button>
        </div>
      </template>
    </el-dialog>
  </div>
</template>
