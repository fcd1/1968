<?php
  echo head(array('title' => metadata('exhibit', 'title'),
		'bodyclass' => 'exhibits show'));
?>
<div class="headBack">
  <?php
    $imageURL = img("1968-banner-3.jpg");
    if ($imageURL != "")
      echo "<div id=" . '"head-back-img"' . 
           " style='padding:0;margin:0;background:url(\"$imageURL\") top right no-repeat'>";
  ?>
  <h1 class="exhHeader">1968: Columbia in Crisis</h1>
  <?php if ($imageURL) echo "</div>"; ?>
</div>
<?php
  // fcd1, 9/9/11: In Omeka 1.5.3, exhibitions had sections, with no landing page.
  // When a section was selected, the first page in the section was displayed
  // From Omeka 2.0 on, there are no more sections. Instead, there are top-level
  // pages, which can have content, and these top-level pages can have child pages.
  // To mimic the Omeka 1.5.3 behavior for legacy exhibitions that were ported to
  // Omeka 2.1, we need to check if the current page is a top-level page, and 
  // display the content of the first child, if there is one. We also need this 
  // info so that "Next" links to the correct page
  $currentExhibitPage = get_current_record('exhibit_page');
  $exhibitPageParent = $currentExhibitPage->getParent();      
  $firstChild = null;
  if (!($exhibitPageParent)) {
    // this is a top-level page, and we want section-like behavior. First page in "section" will display
    // and the breadcrumb links have to reflect this
    $firstChild = $currentExhibitPage->getFirstChildPage();
  }
?>

<table class="layoutTable">
  <tr>
    <td class="exhibit-nav">
      <div id="secondary">
        <div id="nav-container">
          <?php 
            // fcd1, 8/19/13: following is based on exhibit_builder_page_nav,
            // which builds a nav menu list for the lhs
            echo cul_legacy_exhibit_builder_page_nav($firstChild);
          ?>
        </div><!--end id="nav-container"-->
      </div><!--end id="secondary"-->
    </td>
    <td class="content">
      <div class="exhibit-1968-page-navigation">
        <?php $pn = culWritePrevNext($firstChild); ?>
        <?php echo $pn; ?>
      </div>
      <div id="primary">
        <?php 
          // fcd1, 8/30/13: Here, I mimic the behavior of sections in Omeka 1.5.3. These sections did not have
          // landing pages. Instead, the first page in a section would show up. Do the same thing here: if the
          // current page is a top-level page (which would have originally been a section in omeka 1.53),
          // then instead of showing the content of this top-level page, show the content of the first child   
          $currentExhibitPage = get_current_record('exhibit_page');
          $exhibitPageParent = $currentExhibitPage->getParent();      
          $firstChild = null;
          if (!($exhibitPageParent)) {
            // this is a top-level page, and we want section-like behavior. First page in "section" will display
            // and the breadcrumb links have to reflect this
            $firstChild = $currentExhibitPage->getFirstChildPage();
          }
          echo cul_general_breadcrumb($firstChild); 
          // show contents of page
          exhibit_builder_render_exhibit_page($firstChild);
        ?>
      </div><!--end id="primary"-->
      <div class="exhibit-1968-page-navigation">
        <?php echo $pn; ?>
      </div>
    </td>
  </tr>
</table>
<?php echo foot(); ?>

