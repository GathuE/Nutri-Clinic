<div class="card" id="notification_card">
    <?php if (isset($_REQUEST['e'])) {?>
            <div class="alert alert-danger">
                <?php echo $_REQUEST['e']; ?>
            </div>
    <?php } ?>
    <?php if (isset($_REQUEST['s'])) {?>
            <div class="alert alert-success">
                <?php echo $_REQUEST['s']; ?>
            </div>
    <?php } ?>
</div>