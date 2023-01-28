let likeBtn = document.querySelectorAll(".heart-container");
const url = "http://proyecto-laravel.com.devel/";
let dataID = document.get;

likeBtn.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        let id = btn.getAttribute("data-id");
        if(btn.firstChild.classList.contains('redheart')){
            btn.firstChild.classList.toggle("redheart");
            async function dislike() {
                fetch(url+"dislike/"+id).then((res) => res.json());
            }
            dislike();            
        }else{
            btn.firstChild.classList.toggle("redheart");
            async function like() {
                fetch(url+"like/"+id).then((res) => res.json());
            }
            like();
        }
    });
});
