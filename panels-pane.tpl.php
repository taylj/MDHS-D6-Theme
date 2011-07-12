<?php
// $Id: panels-pane.tpl.php,v 1.1.2.1 2009/11/05 03:20:35 sociotech Exp $
/**
 * @file panels-pane.tpl.php
 * Main panel pane template
 *
 * Variables available:
 * - $pane->type: the content type inside this pane
 * - $pane->subtype: The subtype, if applicable. If a view it will be the
 *   view name; if a node it will be the nid, etc.
 * - $title: The title of the content
 * - $content: The actual content
 * - $links: Any links associated with the content
 * - $more: An optional 'more' link (destination only)
 * - $admin_links: Administrative links associated with the content
 * - $feeds: Any feed icons or associated with the content
 * - $display: The complete panels display object containing all kinds of
 *   data including the contexts and all of the other panes being displayed.
 */

/**
 * $skinr variable, <div class="inner">, and 'content' in
 * <div class="pane-content content"> added for Fusion theming
 */
$twitter_account = variable_get('mdhs_twitter', 'MDHS_SC');
?>
<div class="<?php print $classes; ?> <?php print $skinr; ?>" <?php print $id; ?>>
  <div class="inner">
    <?php if ($admin_links): ?>
      <div class="admin-links panel-hide">
        <?php print $admin_links; ?>
      </div>
    <?php endif; ?>

    <?php if ($title): ?>
      <h2 class="pane-title block-title">
        <span class="block-title-inner"><?php print $title; ?></span>
        <?php if (strtolower($title) == 'latest news' || strtolower($title) == 'events' || strtolower($title) == 'coming events'): ?>
          <span id="rss-twitter-wrapper">
            <?php if (strtolower($title) == 'latest news'): ?>
              <a href="<?php print base_path() . 'latest-news/feed'; ?>" class="rss-icon">
                <img src="<?php print drupal_get_path('theme', 'mdhs') .'/images/RSS.png'; ?>" />
              </a>
            <?php elseif (strtolower($title) == 'events' || strtolower($title) == 'coming events'): ?>
              <a href="<?php print base_path() . 'events/feed'; ?>" class="rss-icon">
                <img src="<?php print drupal_get_path('theme', 'mdhs') .'/images/RSS.png'; ?>" />
              </a>
            <?php endif; ?>
            <a href="http://twitter.com/<?php print $twitter_account; ?>">
              <img src="<?php print drupal_get_path('theme', 'mdhs') .'/images/Twitter.png'; ?>" />
            </a>
          </span>
        <?php endif; ?>
      </h2>
    <?php endif; ?>

    <?php if ($feeds): ?>
      <div class="feed">
        <?php print $feeds; ?>
      </div>
    <?php endif; ?>

    <div class="pane-content content">
      <?php print $content; ?>
    </div>

    <?php if ($links): ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>

    <?php if ($more): ?>
      <div class="more-link">
        <?php print $more; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
