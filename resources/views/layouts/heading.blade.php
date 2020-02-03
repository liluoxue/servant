<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="http://diogua.com">DIOGUA</a></li>
    <li class="layui-nav-item layui-this"><a href="">学委小工具</a></li>
    <li class="layui-nav-item"><a href="">大数据</a></li>
    <li class="layui-nav-item">
      <a href="javascript:;">学委小工具</a>
      <dl class="layui-nav-child"> <!-- 二级菜单 -->
        <dd><a href="">作业上传</a></dd>
        <dd><a href="">综测计算</a></dd>
        <dd><a href="">统计人数</a></dd>
      </dl>
    </li>
    <li class="layui-nav-item"><a href="">社区</a></li>
  </ul>
  <script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
      var element = layui.element;
      
      //…
    });
    </script>