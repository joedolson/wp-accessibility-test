<div class="searchform">
<form method="get" action="<?php echo home_url(); ?>" role="search" class="header">
	<p>
	<label for="s">Search</label>
	<input type="search" name="s" id="s" value="<?php the_search_query(); ?>" /><input type="submit" name="submit" value="Search Issues" class="button" />
	</p>
</form>
</div>