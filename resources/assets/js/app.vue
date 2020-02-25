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
            <Dropdown v-else @on-click="listjudge">
              <Button>
                {{formline.username}}
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
    <Modal v-model="loginmodal" title="登录" @on-ok="ok" @on-cancel="cancel">
      <div style="text-align:center">
        <Form ref="formline" :model="formline" rules="ruleInline">
          <FormItem label="用户名" prop="user">
            <Input type="text" v-model="formline.username" placeholder="用户名"></Input>
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
        buttonif: true,
        menuactive : 3,
        formline: {
          username: '123',
          password: ''
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

    methods: {

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
          this.$router.push('/up');
        } else
        if (name == 3) {
          this.$router.push('/adminlist');
        }
        if(this.$route.path=='/')
        {
          menuactive='1';
        }
        if(this.$route.path=='/adminlist')
        {
          menuactive='3';
        }
      },
      loginmodalalert: function () {
        this.loginmodal = true;
      },
      
      login: function (name) {
        let formdata = new FormData();
        formdata.append('email', this.formline.username);
        formdata.append('password', this.formline.password);

        axios.post('/servant/api/auth/login', formdata).then(res => {
          console.log(res);
          if (res.data.access_token) {
            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.access_token;
            console.log(res.data.access_token);
            this.buttonif = false;
            this.loginmodal = false;
            this.$Message.success('登录成功');
          }
        })

      },
      logout: function () {
        let formdata = new FormData();
        formdata.append('email', this.formline.username);
        formdata.append('password', this.formline.password);

        axios.post('/servant/api/auth/logout', formdata).then(res => {
          //console.log(res);
          axios.defaults.headers.common['Authorization'] = '';
          this.buttonif=true;
          this.$Message.success('退出成功');
        })

      },
      listjudge:function(name){
        console.log(name);
        if(name=="logout")
          this.logout();
      },
    }
  }
</script>