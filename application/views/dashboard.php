<div class="content-wrapper">
    <section class="content-header">
        <h1>
        accueil
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">accueil</li>
        </ol>
    </section>

    <!-- Panel Section -->
    <section class="content">
    <?php if(in_array('viewStock', $user_permission)): ?>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- Total articles -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $total_articles ?></h3>
                            <p>article</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo base_url('stock/') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(in_array('viewArt', $user_permission)): ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- Total article_stock -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $total_articleStock ?></h3>
                            <p>article_stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo base_url('artstock/') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(in_array('viewUser', $user_permission)): ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- Total Users -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $total_users; ?></h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        <a href="<?php echo base_url('users/') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(in_array('viewEmp', $user_permission)): ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- Total emp -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $total_emplacement ?></h3>
                            <p>emplacement</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-home"></i>
                        </div>
                        <a href="<?php echo base_url('emplacement/') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        <?php endif; ?>
    </section>

    
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#dashboardMainMenu").addClass('active');
    });
</script>
