<?php
  // fcd1, 8/27/13: foolowing file is based on plugins/ExhibitBuilder/views/public/exhibits/item.php
  // with customization to match behavior of cul-teneral's item.php from OMeka 1.5.3
?>

<?php
  echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),
		  'bodyclass' => 'exhibits exhibit-item-show'));
?>

<div id="item-page-content">
  <div id="primary" class="show">
    <h3 class="exhibit-title-link">Exhibit: 
    <?php echo exhibit_builder_link_to_exhibit(null,null,array('class' => 'link-to-exhibit')); ?>
    </h3>
    <table>
      <tr>
        <td>
          <?php
            // fcd1, 01/27/14
            // Print a link back to the exhibit page containing the item..
            // Unfortunately, from the item page, there is no way
            // to get the exhibit page we came from - get_current_record('exhibit_page')
            // returns an error. So, instead, we will see if the link to the previous
            // page (use $_SERVER['HTTP_REFERER']) is a link to one of the pages
            // which contains the item. This may not always be the case, since it is
            // possible that the user arrived on the item page via a web search. In
            // this case, do not print a link back to the exhibit page. 
            if (array_key_exists('HTTP_REFERER',$_SERVER)) {
              $http_previous = $_SERVER['HTTP_REFERER'];
              $exhibit_pages = cul_return_exhibit_pages_containing_current_item();
              $exhibit_page_containing_item = NULL;
              foreach($exhibit_pages as $exhibit_page) {
                $exhibit = $exhibit_page->getExhibit();
                if ( (strstr($http_previous,exhibit_builder_exhibit_uri($exhibit, $exhibit_page))) ||
                  // fcd1, 01/27/14:
                  // add the following test for legacy exhibitions (from Omeka 1.5.3)
                  // because the previous page may be a top-level page which displays the contents
                  // of the first child page, to mimic the behavior of sections in Omeka 1.5.3
                     (strstr($http_previous,
                             exhibit_builder_exhibit_uri($exhibit,$exhibit_page->getFirstChildPage() )
                            )
                     )
                   )
                {
                  $exhibit_page_containing_item = $exhibit_page;
                  break;
                }
              }
              if ($exhibit_page_containing_item) {
                echo '<h3>View item in context</h3>';
                echo '<p><a href="'.
                  html_escape(exhibit_builder_exhibit_uri($exhibit, $exhibit_page_containing_item)).
                  '">'.$exhibit->title.': '.$exhibit_page_containing_item->title.'</a></p>';
              }
            }
          ?>
          <h1 class="item-title">Item Information</h1>
            <div id="itemfiles">
              <?php 
                // fcd1, 01/16/14:
                // change imageSize from thumbnail (as set in original code)
                // to fullsize
                echo files_for_item(array('imageSize' => 'fullsize',
					  'linkAttributes' => array('onclick' => 'return hs.expand(this)',
								    'class' => 'highslide')
					  )
				    );
              ?>
            </div>

          <?php echo all_element_texts('item'); ?>

          <?php if (metadata('item', 'has tags')): ?>
            <div class="tags">
              <h3><?php echo __('Tags'); ?></h3>
              <?php echo tag_string('item'); ?>
            </div>
          <?php endif;?>

          <div id="citation" class="field">
            <h3><?php echo __('Citation'); ?></h3>
            <p id="citation-value" class="field-value"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></p>
          </div>
          <?php cul_display_links_to_exhibit_pages_containing_item(); ?>
        </td>
      </tr>
    </table>
  </div><!--end id="primary"-->
</div><!--end id="item-page-content"-->

<?php echo foot(); ?>
