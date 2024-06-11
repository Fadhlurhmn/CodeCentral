<style>
  /* For WebKit browsers (Chrome, Safari) */
  .custom-scrollbar::-webkit-scrollbar {
      width: 0px;  /* Remove scrollbar space */
      background: transparent;  /* Optional: just make scrollbar invisible */
  }
  
  /* For Firefox */
  .custom-scrollbar {
      scrollbar-width: none;  /* Remove scrollbar space */
      -ms-overflow-style: none;  /* IE and Edge */
  }
  
  /* To make sure the custom-scrollbar class is applied properly */
  .custom-scrollbar {
      overflow-y: auto;
  }
</style>
@include('layout.start')


@include('layout.rt_navbar')


<!-- strat wrapper -->
<div class="h-screen w-full flex">
    @include('layout.rt_sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col flex-grow overflow-auto custom-scrollbar"> 
      @include('rt.keluarga.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
