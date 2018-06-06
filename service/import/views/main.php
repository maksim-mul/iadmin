<div class="loader">
   <center>
       <img class="loading-image" src="loading.jpg" alt="loading..">
   </center>
</div>

<style>
.loading-image {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 10;
}
.loader
{
    display: none;
    width:200px;
    height: 200px;
    position: fixed;
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
    overflow: auto;
}
</style>

<script>
$.ajax({
  // your ajax code
  beforeSend: function(){
       $('.loader').show()
   },
  complete: function(){
       $('.loader').hide();
  }
});
</script>
