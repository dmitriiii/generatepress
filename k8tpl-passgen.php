<?php /* Template Name: Password Generator
Template Post Type: page */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>
<style>
	.pgen-app{
		overflow: hidden;
	}
	button.pgen-pass__copy:hover,
	button.pgen-pass__repeat:hover,
	button.pgen-pass__copy:focus,
	button.pgen-pass__repeat:focus{
		background-color: inherit;
	}
	.pgen-lock{
		max-width: 100px;
	}
</style>
<!-- <div id="page"> -->
	<div class="all-wrapper">
	  <div class="pgen-app">
	    <div class="snackbar"><div class="snackbar__txt"><? the_field('pg_message'); ?></div></div>
	    <div class="pgen-container">
		<div class="pgen-header">
		  <img class="pgen-lock" src="<?= get_template_directory_uri() ?>/modules/passgen/img/lock.png" />
		  <? the_field('pg_top_text'); ?>
		</div>
		<div class="pgen-pass">
		  <input class="pgen-pass__input" readonly="readonly" /> <button class="pgen-pass__copy" title="copy password"><img src="<?= get_template_directory_uri() ?>/modules/passgen/img/copy.svg" /></button>
		  <button class="pgen-pass__repeat" title="repeat password generation"><img src="<?= get_template_directory_uri() ?>/modules/passgen/img/repeat.svg" /></button>
		</div>
		<div class="pgen-tab">
		  <div class="pgen-tab__btns"><button class="pgen-tab__btn active" disabled="disabled"><? the_field('pg_tab_1'); ?></button> <button class="pgen-tab__btn"><? the_field('pg_tab_2'); ?></button></div>
		  <div class="pgen-tab__inner">
		    <div class="pgen-tab__content active">
					<form class="form pgen-form pgen-form--remember">
					  <div class="pgen-options__basic">
					    <label class="form-el form-el--slide">
						<span class="form-el__label"><? the_field('pg_easy_label_1'); ?></span> <input class="form-el__inp form-el__inp--sm form-el__inp--center" min="1" max="24" value="6" name="pwlength" />
						<div class="slide"><input class="slide__slider" type="range" min="1" max="24" value="6" /></div>
					    </label>
					  </div>
					  <div class="pgen-options__default">
					    <label class="form-el form-el--multiline" data-error="<? the_field('pg_easy_error_2'); ?>">
						<span class="form-el__label"><? the_field('pg_easy_label_2'); ?></span> <input class="form-el__inp" name="noun" required />
					    </label>
					    <label class="form-el form-el--multiline" data-error="<? the_field('pg_easy_error_3'); ?>">
						<span class="form-el__label"><? the_field('pg_easy_label_3'); ?></span> <input class="form-el__inp" name="adjective" required />
					    </label>
					    <label class="form-el form-el--multiline" data-error="<? the_field('pg_easy_error_4'); ?>">
						<span class="form-el__label"><? the_field('pg_easy_label_4'); ?></span> <input class="form-el__inp" type="number" min="0" name="luckynumber" required />
					    </label>
					    <label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwuc" checked="checked" /><span class="form-el__label"><? the_field('pg_easy_label_5'); ?></span></label>
					    <label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwsymb" /><span class="form-el__label"><? the_field('pg_easy_label_6'); ?></span></label>
					  </div>
					  <div class="pgen-options__notice"><? the_field('pg_easy_label_7'); ?></div>
					</form>
		    </div>
		    <div class="pgen-tab__content" hidden>
					<div class="pgen-options" action="">
					  <div class="pgen-options__mode">
					    <div class="pgen-mode">
						<div class="pgen-mode__select"><? the_field('pg_sec_label_1'); ?></div>
						<label class="switcher"><input class="switcher__input" type="checkbox" /><span class="switcher__slider"></span></label>
					    </div>
					  </div>
					  <form class="form pgen-form pgen-form--default">
					    <div class="pgen-options__basic">
						<label class="form-el form-el--slide">
						  <span class="form-el__label"><? the_field('pg_sec_label_2'); ?></span> <input class="form-el__inp form-el__inp--sm form-el__inp--center" min="1" max="24" value="6" name="pwlength" />
						  <div class="slide"><input class="slide__slider" type="range" min="1" max="24" value="6" /></div>
						</label>
					    </div>
					    <div class="pgen-options__advanced" hidden>
						<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwnum" checked="checked" /><span class="form-el__label"><? the_field('pg_sec_label_3'); ?></span></label>
						<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwlc" checked="checked" /><span class="form-el__label"><? the_field('pg_sec_label_4'); ?></span></label>
						<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwuc" checked="checked" /><span class="form-el__label"><? the_field('pg_sec_label_5'); ?></span></label>
						<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwsymb" /><span class="form-el__label"><? the_field('pg_sec_label_6'); ?></span></label>
						<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwspace" /><span class="form-el__label"><? the_field('pg_sec_label_7'); ?></span></label>
					    </div>
					  </form>
					</div>
		    </div>
		  </div>
		</div>
		<p class="pgen-notice">
		  <? the_field('pg_sec_notice'); ?>
		</p>
	    </div>
	  </div>
	</div>
<!-- </div> -->



<div id="page" class="hfeed site grid-container container grid-parent">
	<div id="content" class="site-content">
		<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
			<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
				<?php
				/**
				 * generate_before_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_before_main_content' );

				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || '0' != get_comments_number() ) :
						/**
						 * generate_before_comments_container hook.
						 *
						 * @since 2.1
						 */
						do_action( 'generate_before_comments_container' );
						?>

						<div class="comments-area">
							<?php comments_template(); ?>
						</div>

						<?php
					endif;

				endwhile;

				/**
				 * generate_after_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_after_main_content' );
				?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		/**
		 * generate_after_primary_content_area hook.
		 *
		 * @since 2.0
		 */
		do_action( 'generate_after_primary_content_area' );

		generate_construct_sidebars(); ?>
	</div><!-- #content -->
</div><!-- #page -->
<?
get_footer();