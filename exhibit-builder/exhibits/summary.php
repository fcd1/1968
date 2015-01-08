<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<div class="headBack">
  <?php
  $imageURL = img("1968-banner-3.jpg");
  if ($imageURL != "")
    echo "<div style='padding:0;margin:0;width:100%;background:url(\"$imageURL\") top right no-repeat'>";
  ?>
  <h1 class="exhHeader">1968: Columbia in Crisis</h1>
  <?php if ($imageURL) echo "</div>"; ?>
</div><!--end class="headBack"-->
<!-- end custom header -->

<table class="layoutTable">
  <tr>
    <td class="exhibit-nav">
      <div id="secondary">
        <ul class="exhibit-section-nav">
          <li>
            <?php
              $title = exhibit_builder_link_to_exhibit(get_current_record('exhibit'),
						       "Home",
						       array('style' => 'font-weight:bold;'));
              echo $title;
            ?>
          </li>
          <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
          <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
	    <?php 
	      $html = '<li>' . '<a href="' . 
                      exhibit_builder_exhibit_uri(get_current_record('exhibit'), 
						  $exhibitPage) .'">'. 
                                                  cul_insert_angle_brackets(metadata($exhibitPage, 'title')) .
                                                 '</a></li>';

              echo $html;
            ?>
          <?php endforeach; ?>
	</ul>
      </div><!--end id="secondary"-->
    </td>
    <td class="content">
      <div class="exhibit-description">
        <?php echo $exhibit->description; ?>
        <?php
          $imageURL = img("1968-banner-3.jpg");
        ?>
      </div><!--end class="exhibit-description"-->
      <div id="exhibit-credits">	
        <h3>Exhibit Curator</h3>
        <p>
          <?php echo $exhibit->credits; ?>
        </p>
      </div>

      <div id="exhibit-sections">
        <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
          <?php 
	    $html = '<h3><a href="' . 
                    exhibit_builder_exhibit_uri(get_current_record('exhibit'), 
						$exhibitPage) . '">' . 
                    cul_insert_angle_brackets(metadata($exhibitPage, 'title')) .'&nbsp;&raquo;</a></h3>';
            // fcd1, 01/08/15:
            // function exhibit_builder_page_text(), available in plugin Exhibit Builder version 2.1.1,
            // has been removed from Exhibit Builder 3.1.1, which is the version bundled with Omeka 2.2.2 .
            // Old code:
            // $html .= exhibit_builder_page_text(1);
            // New code (Exhibit Builder 3.1.1 uses content blocks):
            $pageBlocks = $exhibitPage->getPageBlocks();
            $textBlock = $pageBlocks[0];
            $html .= $textBlock->text;
            echo $html;
          ?>
        <?php endforeach; ?>
      </div><!--end id="exhibit-sections"-->
    </td>
  </tr>
</table>

<?php echo foot(); ?>

