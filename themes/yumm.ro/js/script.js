  var $jq = jQuery.noConflict();
$jq(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 560;
  var slides = $jq('.slide');
  var numberOfSlides = slides.length;

  // Remove scrollbar in JS
  $jq('#slidesContainer').css('overflow', 'hidden');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $jq('#slideInner').css('width', slideWidth * numberOfSlides);

  // Insert controls in the DOM
  $jq('#slideshow')
    .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
    .append('<span class="control" id="rightControl">Clicking moves right</span>');

  // Hide left arrow control on first load
  manageControls(currentPosition);

  // Create event listeners for .controls clicks
  $jq('.control')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($jq(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $jq('#slideInner').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $jq('#leftControl').hide() } else{ $jq('#leftControl').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $jq('#rightControl').hide() } else{ $jq('#rightControl').show() }
  }	

   $jq('#gaseste').bind('click', function(){ 

      var oras = $jq('#oras').val();
      var meniu = $jq('#meniu').val();
      var pathname = window.location.host;

      alert(pathname);
      alert(oras);
      alert(meniu);

   });
});