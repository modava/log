<?php
\modava\log\assets\LogAsset::register($this);
\modava\log\assets\LogCustomAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<?php echo $content ?>
<?php $this->endContent(); ?>
