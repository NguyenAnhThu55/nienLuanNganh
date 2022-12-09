const rightBtn = document.querySelector('.fa-angle-rights')
const leftBtn = document.querySelector('.fa-angle-lefts')
const product_content_Number = document.querySelectorAll('.slider-product-content--items')
let index = 0
rightBtn.addEventListener('click', function(){
    index = index + 1
    if(index>product_content_Number.lenght-1){
        index = 0
    }
    document.querySelector('.slider-product-content').style.right = index * 103 + "%"
})
leftBtn.addEventListener('click', function(){
    index = index-1
    if(index<=0){
        index = product_content_Number.lenght-1
    }
    document.querySelector('.slider-product-content').style.right = index * 103 + "%"
})