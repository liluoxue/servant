<style scoped>
  .layout {
    border: 1px solid #d7dde4;
    background: #f5f7f9;
    position: relative;
    border-radius: 4px;
    overflow: hidden;
  }

  .layout-logo {
    width: 100px;
    height: 30px;
    background: #5b6270;
    border-radius: 3px;
    float: left;
    position: relative;
    top: 15px;
    left: 20px;
  }

  .layout-nav {
    width: 420px;
    margin: 0 auto;
    margin-right: 20px;
  }

  .layout-footer-center {
    text-align: center;
  }

  .component-fade-enter-active,
  .component-fade-leave-active {
    transition: opacity .3s ease;
  }

  .component-fade-enter,
  .component-fade-leave-to

  /* .component-fade-leave-active for below version 2.1.8 */
    {
    opacity: 0;
  }
</style>
<template>
  <div class="layout">
    <Layout>
      <Header :style="{position:'absolute', width: '100%'}">
        <Menu mode="horizontal" theme="dark" :active-name="menuactive" @on-select="jump">
          <!-- <div class="layout-logo"></div> -->
          <div class="layout-nav">
            <MenuItem name="1">
            <Icon type="ios-navigate"></Icon>
            任务列表
            </MenuItem>
            <!-- <MenuItem name="2" >
                            <Icon type="ios-keypad"></Icon>
                            上传页面
                        </MenuItem> 测试页面-->
            <MenuItem name="2">
            <Icon type="ios-analytics"></Icon>
            后台搜集页面
            </MenuItem>
            
            <Button v-if="buttonif" @click="loginmodalalert">
              登录
            </Button>
            <Button v-if="buttonif" @click="registermodalalert">
              注册
            </Button>
            <Dropdown v-else @on-click="listjudge">
              <Button>
                {{formline.email}}
                <Icon type="ios-arrow-down"></Icon>
              </Button>

              <DropdownMenu slot="list" >
                <DropdownItem name="logout">退出登录</DropdownItem>
                
              </DropdownMenu>
            </Dropdown>
            
          </div>
        </Menu>
      </Header>
      <Content :style="{margin: '160px 50px 0', background: '#fff', minHeight: '650px'}">
        <transition name="component-fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </Content>
      <Footer class="layout-footer-center">2020 &copy; DIOGUA</Footer>
    </Layout>
    <Modal v-model="loginmodal" title="登录" :footer-hide=true >
      <div style="text-align:center">
        <Form ref="formline" :model="formline" rules="ruleInline">
          <FormItem label="邮箱" prop="user">
            <Input type="text" v-model="formline.email" placeholder="邮箱"></Input>
          </FormItem>
          <FormItem label="密码" prop="password">
            <Input type="password" v-model="formline.password" placeholder="密码"></Input>
          </FormItem>
          <FormItem>
            <Button type="primary" @click="login">登录</Button>
          </FormItem>
          <FormItem>
            <Button type="dashed" @click="logout">注销</Button>
          </FormItem>
          <div slot="footer">
          
          </div>
        </Form>
      </div>
    </Modal>
    <Modal v-model="registermodal" title="注册" :footer-hide=true>
      <div style="text-align:center">
        <Form ref="formline" :model="formline" rules="ruleInline">
          <FormItem label="邮箱" prop="user">
            <Input type="text" v-model="formline.email" placeholder="邮箱"></Input>
          </FormItem>
          <FormItem label="昵称" prop="user">
            <Input type="text" v-model="formline.name" placeholder="昵称"></Input>
          </FormItem>
          <FormItem label="密码" prop="password">
            <Input type="password" v-model="formline.password" placeholder="密码"></Input>
          </FormItem>
          <FormItem>
            <Button type="primary" @click="register">注册</Button>
          </FormItem>
          <div slot="footer">
          
          </div>
        </Form>
      </div>
    </Modal>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        isCollapsed: false,
        loginmodal: false,
        registermodal:false,
        buttonif: true,
        menuactive : 3,
        formline: {
          name: '123',
          email:'',
          password: '',
          phone: ''
        }
      };
    },
    computed: {
      menuitemClasses: function () {
        return [
          'menu-item',
          this.isCollapsed ? 'collapsed-menu' : ''
        ]
      }

    },
    created:function() {
      axios.defaults.headers.common['Authorization'] = document.cookie;
      //console.log(document.cookie);
      this.getme();
      },
    methods: {
      getme: function(){
        axios.post('/api/auth/me').then(res=>{
          this.formline.email=res.data.email;
          this.formline.name=res.data.name;
          if(res.data.admin==1)
          {
            this.storageData.setAdmin(true);

          }
          else
          {
            this.storageData.setAdmin(false);
          }
          this.buttonif=false;
        }).catch(err=>{
          this.$Message.error('relogin~');
          axios.defaults.headers.common['Authorization']='';
        })
      },
      toUp: function () {
        this.$router.push('/up');
      },
      toHome: function () {
        this.$router.push('/');
      },
      toAdmin: function () {
        this.$router.push('/admin');
      },
      jump: function (name) {
        console.log(name);
        if (name == 1) {

          this.$router.push('/');
        } else
        if (name == 2) {
          //console.log(axios.defaults.headers.common['Authorization']);
          this.$router.push('/adminlist');
        }
        if(this.$route.path=='/')
        {
          this.menuactive='1';
        }
        if(this.$route.path=='/adminlist')
        {
          this.menuactive='2';
        }
      },

      loginmodalalert: function () {
        this.loginmodal = true;
      },
      registermodalalert: function () {
        this.registermodal = true;
      },
      register:function(){
        let formdata=new FormData();
        formdata.append('name',this.formline.name);
        formdata.append('email',this.formline.email);
        formdata.append('password',this.formline.password);
        console.log(this.formline);
        axios.post('/api/auth/register',formdata).then(res=>{
          console.log(res);
          this.registermodal=false;
          this.$Message.success('注册成功');
          
        }).catch(res=>{
          this.$Message.error("注册失败");
        })
        /* axios.post('/api/auth/me').then(res=>{
          console.log(axios.defaults.headers.common['Authorization']);
          
          
        }) */
      },
      login: function (name) {
        let formdata = new FormData();
        formdata.append('email', this.formline.email);
        formdata.append('password', this.formline.password);

        axios.post('/api/auth/login', formdata).then(res => {
          //console.log(res);
          if (res.data.access_token) {
            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.access_token;
            //console.log(res.data.access_token);
            document.cookie = "Bearer " + res.data.access_token;
            axios.post('/api/auth/user',formdata).then(res=>{
                console.log(res.data);
                if(res.data.admin==1)
                {
                  this.storageData.setAdmin(true);
                  console.log(this.storageData.isAdmin);
                }
                else
                {
                  this.storageData.setAdmin(false);
                }
            })
            
            this.buttonif = false;
            this.loginmodal = false;
            this.$Message.success('登录成功');
          }
        }).catch(res=>{
          console.log(res);
          this.$Message.error(res);
        })

      },
      logout: function () {
        let formdata = new FormData();
        formdata.append('email', this.formline.email);
        formdata.append('password', this.formline.password);

        axios.post('/api/auth/logout', formdata).then(res => {
          //console.log(res);

        })
        axios.defaults.headers.common['Authorization'] = '';
        this.buttonif=true;
        this.$Message.success('退出成功');

      },
      listjudge:function(name){
        console.log(name);
        if(name=="logout")
          this.logout();
      },
    }
  }
</script>