<nav class="navbar navbar-default" role="navigation">

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-slide-dropdown">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a href="#menu-toggle" class="menu-toggle sidebar-close">
		<i class="fa fa-chevron-circle-left fa-2"></i>
	  </a>

	  <a href="#menu-toggle" class="menu-toggle sidebar-open">
		<i class="fa fa-chevron-circle-right fa-2"></i>
	  </a>

      <a class="navbar-brand" href="#">Garden Revolution</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-slide-dropdown">

        <ul class="nav navbar-nav navbar-right" id="user-options">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                	<a href="#profile">
                		<i class="fa fa-user"></i>
                		<span>Profile</span>
                	</a>
				</li>
                <li>
                	<a href="#settings">
                		<i class="fa fa-cog"></i>
                		<span>Settings</span>
                	</a>
                </li>
                <li class="divider"></li>              
                <li>
                	<a href="#logout">
                		<i class="fa fa-sign-out"></i>
                		<span>Sign Out</span>
                	</a>
                </li>
              </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script type="text/javascript">
	$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>