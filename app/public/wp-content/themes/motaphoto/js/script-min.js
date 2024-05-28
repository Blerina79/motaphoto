
jQuery(document).ready(function($){function updatePhotoGallery(){var category=$('#categorie-img').val();var format=$('#format').val();var sort=$('#filtre-tri').val();$.ajax({url:ajax_object.ajaxurl,type:'POST',data:{action:'filter_photos',category:category,format:format,sort:sort},success:function(response){if(response.success){$('#photo-gallery').html(response.data.content)}else{$('#photo-gallery').html('<p>Aucune photo trouvée.</p>')}}})}
$('#categorie-img, #format, #filtre-tri').change(updatePhotoGallery);$('#load-more-photos').on('click',function(){var button=$(this);var page=button.data('page')||2;$.ajax({url:ajax_object.ajaxurl,type:'POST',data:{action:'load_more_photos',page:page},success:function(response){response=JSON.parse(response);if(response.content){$('#photo-gallery').append(response.content);button.data('page',response.page)}}})});$(document).on('click','.open-contact-modal, .open-contact-modal a',function(e){e.preventDefault();let reference=$(this).data('reference');if(reference){$('#photo-reference').val(reference)}
$('#contact-modal').fadeIn().css('display','flex')});$(document).on('click','.close-modal',function(){$('.contact-modal').fadeOut()});$(document).mouseup(function(e){var modal=$("#contact-modal .modal-content");if(!modal.is(e.target)&&modal.has(e.target).length===0){$('#contact-modal').fadeOut()}});const navToggler=document.querySelector('.nav-toggler');const menuContent=document.querySelector('.burger-menu-content');navToggler.addEventListener('click',function(){this.classList.toggle('active');const header=document.querySelector('header');header.classList.toggle('fixed');menuContent.classList.toggle('active')});document.addEventListener('click',function(event){if(!navToggler.contains(event.target)&&!menuContent.contains(event.target)){navToggler.classList.remove('active');menuContent.classList.remove('active')}})});jQuery(document).ready(function($){let currentIndex=0;let photos=[];function initializePhotoBlocks(){photos=Array.from(document.querySelectorAll('.photo-block'));photos.forEach((block,index)=>{block.querySelector('.photo-fullscreen').addEventListener('click',function(e){e.preventDefault();currentIndex=index;openLightbox()})})}
function openLightbox(){let block=photos[currentIndex];let container=document.querySelector('.containerLightbox');let lightboxImg=document.querySelector('.lightboxImage');let title=block.querySelector('.photo-title').textContent;let category=block.querySelector('.photo-category').textContent;let imgSrc=block.querySelector('img').src;container.style.display='flex';lightboxImg.src=imgSrc;document.querySelector('.lightboxTitle').textContent=title+' - '+category}
document.querySelector('.lightbox__close').addEventListener('click',function(){document.querySelector('.containerLightbox').style.display='none'});document.querySelector('.lightbox__prev').addEventListener('click',function(){currentIndex=(currentIndex>0)?currentIndex-1:photos.length-1;openLightbox()});document.querySelector('.lightbox__next').addEventListener('click',function(){currentIndex=(currentIndex<photos.length-1)?currentIndex+1:0;openLightbox()});initializePhotoBlocks()})