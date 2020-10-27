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
	    <div class="snackbar"><div class="snackbar__txt">Password copied</div></div>
	    <div class="pgen-container">
		<div class="pgen-header">
		  <img class="pgen-lock" src="<?= get_template_directory_uri() ?>/modules/passgen/img/lock.png" />
		  <h1>Generate a secure password</h1>
		  <p>Use this free Password Generator to generate very safe passwords that are hard to crack or guess.</p>
		</div>
		<div class="pgen-pass">
		  <input class="pgen-pass__input" readonly="readonly" /> <button class="pgen-pass__copy" title="copy password"><img src="<?= get_template_directory_uri() ?>/modules/passgen/img/copy.svg" /></button>
		  <button class="pgen-pass__repeat" title="repeat password generation"><img src="<?= get_template_directory_uri() ?>/modules/passgen/img/repeat.svg" /></button>
		</div>
		<div class="pgen-tab">
		  <div class="pgen-tab__btns"><button class="pgen-tab__btn active" disabled="disabled">Easy to remember</button> <button class="pgen-tab__btn">Highly secure</button></div>
		  <div class="pgen-tab__inner">
		    <div class="pgen-tab__content active">
			<form class="form pgen-form pgen-form--remember">
			  <div class="pgen-options__basic">
			    <label class="form-el form-el--slide">
				<span class="form-el__label">Length</span> <input class="form-el__inp form-el__inp--sm form-el__inp--center" min="1" max="24" value="6" name="pwlength" />
				<div class="slide"><input class="slide__slider" type="range" min="1" max="24" value="6" /></div>
			    </label>
			  </div>
			  <div class="pgen-options__default">
			    <label class="form-el form-el--multiline" data-error="Please enter your special noun">
				<span class="form-el__label">Is there a <strong class="blue">word</strong> that is special to you? (eg. dog's/cat's name)</span> <input class="form-el__inp" name="noun" required />
			    </label>
			    <label class="form-el form-el--multiline" data-error="Please enter an adjective">
				<span class="form-el__label"><strong class="green">Adjective</strong> characterizing <strong class="blue">word</strong> (eg. white, cute)</span> <input class="form-el__inp" name="adjective" required />
			    </label>
			    <label class="form-el form-el--multiline" data-error="Please enter your lucky number">
				<span class="form-el__label">Enter your lucky number</span> <input class="form-el__inp" type="number" min="0" name="luckynumber" required />
			    </label>
			    <label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwuc" checked="checked" /><span class="form-el__label">Include Uppercase Characters ( ABCDEF... )</span></label>
			    <label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwsymb" /><span class="form-el__label">Include Symbols ( {}[]()/\'"$#~+-,;:. )</span></label>
			  </div>
			  <div class="pgen-options__notice">If you forget your password, you can re-enter the same parameters, to restore it.</div>
			</form>
		    </div>
		    <div class="pgen-tab__content" hidden>
			<div class="pgen-options" action="">
			  <div class="pgen-options__mode">
			    <div class="pgen-mode">
				<div class="pgen-mode__select">Advanced options</div>
				<label class="switcher"><input class="switcher__input" type="checkbox" /><span class="switcher__slider"></span></label>
			    </div>
			  </div>
			  <form class="form pgen-form pgen-form--default">
			    <div class="pgen-options__basic">
				<label class="form-el form-el--slide">
				  <span class="form-el__label">Length</span> <input class="form-el__inp form-el__inp--sm form-el__inp--center" min="1" max="24" value="6" name="pwlength" />
				  <div class="slide"><input class="slide__slider" type="range" min="1" max="24" value="6" /></div>
				</label>
			    </div>
			    <div class="pgen-options__advanced" hidden>
				<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwnum" checked="checked" /><span class="form-el__label">Include Numbers ( 12345 )</span></label>
				<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwlc" checked="checked" /><span class="form-el__label">Include Lowercase Characters ( abcdef... )</span></label>
				<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwuc" checked="checked" /><span class="form-el__label">Include Uppercase Characters ( ABCDEF... )</span></label>
				<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwsymb" /><span class="form-el__label">Include Symbols ( {}[]()/\'"$#~+-,;:. )</span></label>
				<label class="form-el"><input class="form-el__checkbox" type="checkbox" name="pwspace" /><span class="form-el__label">Include Spaces</span></label>
			    </div>
			  </form>
			</div>
		    </div>
		  </div>
		</div>
		<p class="pgen-notice">
		  Note: All the created passwords are only accessible on your local computer and we do not store any results or information that you provide. It is your browser that generates your secure password randomly by using JavaScript.
		  There is no transfer of passwords over the Internet. The benefit of this strategy is that the password created resides on your device and is not distributed to or from an external server.
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