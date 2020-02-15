<style scoped>
    .layout{
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }
    .layout-logo{
        width: 100px;
        height: 30px;
        background: #5b6270;
        border-radius: 3px;
        float: left;
        position: relative;
        top: 15px;
        left: 20px;
    }
    .layout-nav{
        width: 420px;
        margin: 0 auto;
        margin-right: 20px;
    }
    .layout-footer-center{
        text-align: center;
    }
    .component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active for below version 2.1.8 */ {
  opacity: 0;
}
</style>
<template>
    <div class="layout">
        <Layout>
            <Header :style="{position:'absolute', width: '100%'}">
                <Menu mode="horizontal" theme="dark" active-name="1" @on-select="jump">
                    <!-- <div class="layout-logo"></div> -->
                    <div class="layout-nav">
                        <MenuItem name="1" >
                            <Icon type="ios-navigate"></Icon>
                            任务列表
                        </MenuItem>
                        <!-- <MenuItem name="2" >
                            <Icon type="ios-keypad"></Icon>
                            上传页面
                        </MenuItem> 测试页面-->
                        <MenuItem name="3" >
                            <Icon type="ios-analytics"></Icon>
                            后台搜集页面
                        </MenuItem>
                        
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
    </div>
</template>
<script>
  export default {
    data () {
      return {
        isCollapsed: false
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
    methods:{
      
      toUp:function(){
        this.$router.push('/up');
      }
      ,
      toHome: function(){
        this.$router.push('/');
      },
      toAdmin: function(){
        this.$router.push('/admin');
      },
      jump: function(name){
        console.log(name);
        if(name==1)
        {
          
          this.$router.push('/');
        }
        else
        if(name==2)
        {
          this.$router.push('/up');
        }
        else
        if(name==3)
        {
          this.$router.push('/adminlist');
        }
        
      }
    }
  }
</script>