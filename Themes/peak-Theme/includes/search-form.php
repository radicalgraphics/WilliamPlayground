<form method="get" class="main-search-form" action="<?php echo home_url(); ?>">
	<?php $value = __( 'Search&hellip;', 'onioneye' ); ?>
	<input type="text" class="main-search-field" name="s" id="s" value="<?php echo $value; ?>" onfocus="if (this.value == '<?php echo $value; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $value; ?>';}" />
	<input type="submit" class="main-search-submit" value="" />
</form>
