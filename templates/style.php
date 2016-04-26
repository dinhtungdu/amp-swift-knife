<?php $titan = $titan = TitanFramework::getInstance( 'ampsk' );
$logoHeight = $titan->getOption('amp_sk_logo_height');
$buttonHeight= 24;
$padding = ($logoHeight - $buttonHeight)/2;
?>
/* Generic WP styling */
amp-img.alignright { float: right; margin: 0 0 1em 1em; }
amp-img.alignleft { float: left; margin: 0 1em 1em 0; }
amp-img.aligncenter { display: block; margin-left: auto; margin-right: auto; }
.alignright { float: right; }
.alignleft { float: left; }
.aligncenter { display: block; margin-left: auto; margin-right: auto; }

.wp-caption.alignleft { margin-right: 1em; }
.wp-caption.alignright { margin-left: 1em; }

.amp-wp-enforced-sizes {
/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
max-width: 100%;
}

.amp-wp-unknown-size img {
/** Worst case scenario when we can't figure out dimensions for an image. **/
/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
object-fit: contain;
}

/* Template Styles */
.amp-wp-content, .amp-wp-title-bar div {
max-width: <?php printf( '%dpx', $titan->getOption('amp_sk_layout_content_width') ); ?>;
margin: 0 auto;
}

.clearfix {
clear: both;
}
.clearfix:before, .clearfix:after {
clear: both;
content: " ";
display: table;
}
<?php
$font = $titan->getOption('amp_sk_typo_fontfamily');
$font_family = "Arial, 'Helvetica Neue', Helvetica, sans-serif";
$font_size = '16px';
$font_color = $font['color'];
if( $font['font-family'] != 'inherit' ) {
	$font_family = $font['font-family'];
}
if( $font['font-size'] != 'inherit' ) {
	$font_size = $font['font-size'];
}
?>
body {
font-family: <?php echo $font_family; ?>;
font-size: <?php echo $font_size; ?>;
line-height: 1.8;
background: #fff;
color: <?php echo $font_color; ?>;
padding-bottom: 100px;
}
h1, h2, h3, h4, h5, h6 {
color: <?php echo $titan->getOption('amp_sk_typo_h_color'); ?>;
}

h1 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h1'); ?>px;
}
h2 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h2'); ?>px;
}
h3 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h3'); ?>px;
}
h4 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h4'); ?>px;
}
h5 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h5'); ?>px;
}
h6 {
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h6'); ?>px;
}
.amp-wp-content {
padding: 16px;
overflow-wrap: break-word;
word-wrap: break-word;
font-weight: 400;
}
.amp-wp-content a {
text-decoration: none;
}
.amp-wp-title {
margin: 15px 0 24px 0;
font-size: <?php echo $titan->getOption('amp_sk_typo_size_h1'); ?>px;
line-height: 1.258;
font-weight: 700;
}

.amp-wp-meta {
margin-bottom: 16px;
}

p,
ol,
ul,
figure {
margin: 0 0 24px 0;
}

a,
a:visited {
color: <?php echo $titan->getOption('amp_sk_typo_a_color'); ?>;
text-decoration: none;
}

a:hover,
a:active,
a:focus {
color: <?php echo $titan->getOption('amp_sk_typo_a_color_hover'); ?>;
}


/* UI Fonts */
.amp-wp-meta,
nav.amp-wp-title-bar,
.wp-caption-text {
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
}


/* Meta */
ul.amp-wp-meta {
padding: 0 0 0 0;
margin: 0 0 24px 0;
}

ul.amp-wp-meta li {
list-style: none;
display: inline-block;
margin: 0;
line-height: 24px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
max-width: 300px;
}

ul.amp-wp-meta li:before {
content: "\2022";
margin: 0 8px;
}

ul.amp-wp-meta li:first-child:before {
display: none;
}

.amp-wp-meta,
.amp-wp-meta a {
color: #4f748e;
}

.amp-wp-meta .screen-reader-text {
/* from twentyfifteen */
clip: rect(1px, 1px, 1px, 1px);
height: 1px;
overflow: hidden;
position: absolute;
width: 1px;
}

.amp-wp-byline amp-img {
border-radius: 50%;
border: 0;
background: #f3f6f8;
position: relative;
top: 6px;
margin-right: 6px;
}


/* Titlebar */
nav.amp-wp-title-bar {
background: #0a89c0;
background: <?php echo $titan->getOption('amp_sk_header_bg'); ?>;
padding: 0 16px;
}

nav.amp-wp-title-bar div {
color: #fff;
<?php if($titan->getOption('amp_sk_logo_position') == 2 ): ?>
	text-align: center;
<?php endif; ?>
}

nav.amp-wp-title-bar a {
color: <?php echo $titan->getOption('amp_sk_site_title_color'); ?>;
text-decoration: none;
}

nav.amp-wp-title-bar span {
display: inline-block;
vertical-align: middle;
margin: 10px;
line-height: <?php echo $titan->getOption('amp_sk_logo_height'); ?>px;
<?php if($titan->getOption('amp_sk_logo_position') == 2 ): ?>
	display: none;
<?php endif; ?>
}

nav.amp-wp-title-bar .amp-wp-site-icon {
/** site icon is 32px **/
margin: 10px;
vertical-align: middle;
<?php if($titan->getOption('amp_sk_logo_position') == 3 ): ?>
	float: right;
<?php endif; ?>
}

/* menu */

.header .menu {
clear: both;
max-height: 0;
transition: max-height .2s ease-out;
list-style: none;
padding-left: 10px;
margin-bottom: 0;
overflow: hidden;
}

.header .menu ul {
display: none;
}

nav.amp-wp-title-bar .menu li {
border-bottom: 1px solid <?php echo $titan->getOption('amp_sk_menu_border_color'); ?>;
padding: 4px 0;
}

nav.amp-wp-title-bar a {
color: <?php echo $titan->getOption('amp_sk_menu_color'); ?>;
text-decoration: none;
font-weight: bold;
}

/* menu icon */
.header .mwrap {
position: relative;
}

.header .menu-icon {
cursor: pointer;
display: inline-block;
float: right;
padding: <?php echo (10 + $padding); ?>px 10px;
position: relative;
user-select: none;
}

.amp-wp-title-bar .mwrap .button-wrap {
margin-top: -<?php echo ( 20 + $logoHeight ); ?>px;
<?php if($titan->getOption('amp_sk_logo_position') == '3') : ?>
float: left;
<?php else: ?>
float: right;
<?php endif; ?>
}

.header .menu-icon .navicon {
background: <?php echo $titan->getOption('amp_sk_menu_hamburger_color'); ?>;
display: block;
height: 3px;
position: relative;
transition: background .2s ease-out;
width: 23px;
}

.header .menu-icon .navicon:before,
.header .menu-icon .navicon:after {
background: <?php echo $titan->getOption('amp_sk_menu_hamburger_color'); ?>;
content: '';
display: block;
height: 100%;
position: absolute;
transition: all .2s ease-out;
width: 100%;
}

.header .menu-icon .navicon:before {
top: 7px;
}

.header .menu-icon .navicon:after {
top: -7px;
}

/* menu btn */

.header .menu-btn {
display: none;
}

.header .mwrap:hover .menu {
max-height: 240px;
max-height: <?php echo $titan->getOption('amp_sk_menu_height'); ?>px;
padding-bottom: 10px;
}
<?php if( $titan->getOption('amp_sk_menu_close') == 1 ) : ?>
.header .mwrap:hover .menu:after {
content: '×';
position: absolute;
right: 20px;
font-size: 40px;
bottom: -40px;
color: <?php echo $titan->getOption('amp_sk_menu_hamburger_color'); ?>;
pointer-events: none;
line-height: 1;
}
<?php endif; ?>

/*
.header .mwrap:hover .menu-icon .navicon {
background: transparent;
}

.header .mwrap:hover .menu-icon .navicon:before {
transform: rotate(-45deg);
}

.header .mwrap:hover .menu-icon .navicon:after {
transform: rotate(45deg);
}

.header .mwrap:hover .menu-icon:not(.steps) .navicon:before,
.header .mwrap:hover .menu-icon:not(.steps) .navicon:after {
top: 0;
}
*/
/*end menu*/

/* Captions */
.wp-caption-text {
padding: 8px 16px;
font-style: italic;
}


/* Quotes */
blockquote {
padding: 16px;
margin: 8px 0 24px 0;
border-left: 2px solid #87a6bc;
color: #4f748e;
background: #e9eff3;
}

blockquote p:last-child {
margin-bottom: 0;
}

/* Other Elements */
amp-carousel {
background: #000;
}

amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
background: #f3f6f8;
}

amp-carousel > amp-img > img {
object-fit: contain;
}

.amp-wp-iframe-placeholder {
background: #f3f6f8 url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
background-size: 48px 48px;
min-height: 48px;
}

/*related post*/
.related-posts {
margin-bottom: 2em;
}
.related-posts ul a {
text-decoration: none;
}

/*comment*/
.comments-area {
margin: 0 7.6923% 3.5em;
}

.comment-list a {
text-decoration: none;
}

.comment-list + .comment-respond,
.comment-navigation + .comment-respond {
padding-top: 1.75em;
}

.comments-title,
.comment-reply-title {
border-top: 4px solid #1a1a1a;
font-family: Montserrat, "Helvetica Neue", sans-serif;
font-size: 23px;
font-size: 1.4375rem;
font-weight: 700;
line-height: 1.3125;
padding-top: 1.217391304em;
}

.comments-title {
margin-bottom: 1.217391304em;
}

.comment-list {
list-style: none;
margin: 0;
}

.comment-list article,
.comment-list .pingback,
.comment-list .trackback {
border-top: 1px solid #d1d1d1;
padding: 1.75em 0;
}

.comment-list .children {
list-style: none;
margin: 0;
}

.comment-list .children > li {
padding-left: 0.875em;
}

.comment-author {
color: #1a1a1a;
margin-bottom: 0.4375em;
}

.comment-author .avatar {
float: left;
height: 28px;
margin-right: 0.875em;
position: relative;
width: 28px;
}

.bypostauthor > article .fn:after {
content: "\f304";
left: 3px;
position: relative;
top: 5px;
}

.comment-metadata,
.pingback .edit-link {
color: #686868;
font-family: Montserrat, "Helvetica Neue", sans-serif;
font-size: 13px;
font-size: 0.8125rem;
line-height: 1.6153846154;
}

.comment-metadata {
margin-bottom: 2.1538461538em;
}

.comment-metadata a,
.pingback .comment-edit-link {
color: #686868;
}

.comment-metadata a:hover,
.comment-metadata a:focus,
.pingback .comment-edit-link:hover,
.pingback .comment-edit-link:focus {
color: #007acc;
}

.comment-metadata .edit-link,
.pingback .edit-link {
display: inline-block;
}

.comment-metadata .edit-link:before,
.pingback .edit-link:before {
content: "\002f";
display: inline-block;
opacity: 0.7;
padding: 0 0.538461538em;
}

.comment-content ul,
.comment-content ol {
margin: 0 0 1.5em 1.25em;
}

.comment-content li > ul,
.comment-content li > ol {
margin-bottom: 0;
}

.comment-reply-link {
border: 1px solid #d1d1d1;
border-radius: 2px;
color: #007acc;
display: inline-block;
font-family: Montserrat, "Helvetica Neue", sans-serif;
font-size: 13px;
font-size: 0.8125rem;
line-height: 1;
margin-top: 0;
padding: 0.5384615385em 0.5384615385em 0.4615384615em;
}

.comment-reply-link:hover,
.comment-reply-link:focus {
border-color: currentColor;
color: #007acc;
outline: 0;
}

.comment-form {
padding-top: 1.75em;
}

.comment-form label {
color: #686868;
display: block;
font-family: Montserrat, "Helvetica Neue", sans-serif;
font-size: 13px;
font-size: 0.8125rem;
letter-spacing: 0.076923077em;
line-height: 1.6153846154;
margin-bottom: 0.5384615385em;
text-transform: uppercase;
}

.comment-list .comment-form {
padding-bottom: 1.75em;
}

.comment-notes,
.comment-awaiting-moderation,
.logged-in-as,
.form-allowed-tags {
color: #686868;
font-size: 13px;
font-size: 0.8125rem;
line-height: 1.6153846154;
margin-bottom: 2.1538461538em;
}

.no-comments {
border-top: 1px solid #d1d1d1;
font-family: Montserrat, "Helvetica Neue", sans-serif;
font-weight: 700;
margin: 0;
padding-top: 1.75em;
}

.comment-navigation + .no-comments {
border-top: 0;
padding-top: 0;
}

.form-allowed-tags code {
font-family: Inconsolata, monospace;
}

.form-submit {
margin-bottom: 0;
}

.required {
color: #007acc;
font-family: Merriweather, Georgia, serif;
}

.comment-reply-title small {
font-size: 100%;
}

.comment-reply-title small a {
border: 0;
float: right;
height: 32px;
overflow: hidden;
width: 26px;
}

.comment-reply-title small a:hover,
.comment-reply-title small a:focus {
color: #1a1a1a;
}

.comment-reply-title small a:before {
content: "\f405";
font-size: 32px;
position: relative;
top: -5px;
}
.comment-author {
margin-bottom: 0;
}

.comment-author .avatar {
height: 42px;
position: relative;
top: 0.25em;
width: 42px;
border-radius: 100%;
}

.comment-list .children > li {
padding-left: 1.75em;
}

.comment-list + .comment-respond,
.comment-navigation + .comment-respond {
padding-top: 3.5em;
}

.comments-area,
.widget,
.content-bottom-widgets .widget-area {
margin-bottom: 5.25em;
}

