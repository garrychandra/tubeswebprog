<input type="text" id="search" placeholder="Search users..." autocomplete="off">
<ul id="suggestions"></ul>

<script>
    document.getElementById('search').addEventListener('input', function(){
        const term = this.value;
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../A_Controller/search_follow.php?term=" + encodeURIComponent(term), true);

        xhr.onload = function () {
            if(xhr.status === 200){
                document.getElementById('suggestions').innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    })
</script>
