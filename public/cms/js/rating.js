function getStars(rating) {
    let stars = '';
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;

    for (let i = 0; i < fullStars; i++) {
        stars += '<i class="fas fa-star" style="color:gold"></i>';
    }

    if (hasHalfStar) {
        stars += '<i class="fas fa-star-half-alt" style="color:gold"></i>';
    }

    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    for (let i = 0; i < emptyStars; i++) {
        stars += '<i class="far fa-star" style="color:gold"></i>';
    }

    return stars;
}

document.querySelectorAll('.stars').forEach(function(el){
    const rating = parseFloat(el.dataset.rating);
    el.innerHTML = getStars(rating);
});


function performDestroy(id, reference){

confirmDestroy('/cms/instructor/instructors/' + id, reference);

}
