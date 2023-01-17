<template>
    <div>
        <div class="container" style="direction:rtl">
            <div class="row mb-5">
                <div class="col-12 text-center mb-3">
                    <h4>لوحة التحكم</h4>
                </div>
                <div class="col-12 col-md-3">
                    <div class="dashboard-menu">
                        <ul>
                            <li>
                                <router-link to="/dashboard">
                                    <i class="fa fa-home"></i>
                                    لوحة التحكم
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/videos">
                                    <i class="fa fa-video"></i>
                                    الفيديوهات
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/orders">
                                    <i class="fa fa-bars"></i>
                                    طلباتي
                                </router-link>
                            </li>
                            <li v-if="auth.type == 1">
                                <router-link to="/logs">
                                    <i class="fa fa-file-alt"></i>
                                    السجل
                                </router-link>
                            </li>
                            <li v-if="auth.type == 0" class="active">
                                <router-link to="/alerts">
                                    <i class="fa fa-bell"></i>
                                    التنبيهات
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/account">
                                    <i class="fa fa-id-card-alt"></i>
                                    بياناتي
                                </router-link>
                            </li>
                            <li>
                                <a href="/logout">
                                    <i class="fa fa-sign-out-alt"></i>
                                    تسجيل الخروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">
                                التنبيهات
                            </h6>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                إضافة تنبيه
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">التنبيهات</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>الحدث</th>
                                                <th>تاريخ الحدث</th>
                                                <th>خيارت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(alert, index) in alerts" :key="index">
                                                <td>{{ alert.event }}</td>
                                                <td>{{ alert.time }}</td>
                                                <td>
                                                    <button
                                                        @click="deleteAlert(index)"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="text-center" v-if="alerts.length == 0">
                                                <td colspan="5">لايوجد تنبيهات.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة تنبيه جديد</h5>
                        <button class="close ml-0 mr-auto" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>الحدث</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="data.event"
                                placeholder="مثلاً: ذكرى زواج، عيد ميلاد"
                            >
                        </div>
                        <div class="form-group">
                            <label>تاريخ الحدث</label>
                            <input
                                type="date"
                                class="form-control"
                                v-model="data.date"
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" id="close-modal" type="button" data-dismiss="modal">إلغاء</button>
                        <button type="button" class="btn btn-primary" @click="add">إضافة</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        if(authUser) {
            axios.get("/request/get-user-alerts")
                .then((res) => {
                    this.alerts = res.data
                })
        } else {
            window.location.href = "/login"
        }
    },
    data: function () {
        return {
            auth: authUser,
            alerts: [],
            data: {
                event: "",
                date: ""
            }
        }
    },
    methods: {
        add() {
          if(this.data.event != '' || this.data.date != '') {
              axios.post("/request/add-alert", {
                  data: this.data
              })
              .then((res) => {
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                  })
                  Toast.fire({
                      icon: 'success',
                      title: 'تمت الإضافة بنجاح'
                  })
                  this.alerts.unshift(res.data)
                  this.data.event = ""
                  this.data.date = ""
                  document.getElementById('close-modal').click()
              })
          }
        },
        deleteAlert(i) {
            let id = this.alerts[i].id
            axios.post("/request/delete-alert", {
                id: id
            })
            .then((res) => {
                if(res.data == 1) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'تم الحذف بنجاح'
                    })
                    this.alerts.splice(i, 1)
                }
            })
        }
    },
    name: "UserAlerts"
}
</script>

<style>
.dashboard-menu ul {
    margin: 0;
    padding: 0;
}
.dashboard-menu ul li {
    margin: 10px 0;
}
.dashboard-menu ul li a {
    display: block;
    width: 100%;
    padding: 10px;
    border-bottom: 1px solid #eee;
}
.dashboard-menu ul li.active a {
    color: blue;
}
.stats .box {
    color: #fff;
    padding: 12px;
    border-radius: 7px;
    height: 100px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    font-size: 20px;
    margin: 10px 0;
}
.stats .box a {
    color: #fff
}
.stats .box.blue {
    background: #5d67f4;
}
.stats .box.green {
    background: #2dce1f;
}
.stats .box.orange {
    background: #ff6000;
}
</style>
