<div class="card m-6 px-1 py-3 bg-sky-300 rounded">
  <div class="card-header m-6 "><h3 class="text-3xl font-bold ">{{$bill->title}}</h3></div>
  <hr>
  <div class="card-body m-6">
      <p class="mb-3 text-lg">Bill Number: {{$bill->bill_no}}</p>
      <p class="mb-3 text-lg">Year Filed: {{$bill->year}}</p>
      <p class="mb-3 text-lg">
      {{$bill->summary}}
      </p>
  </div>
  <div class="mb-3 mx-6">
      
      
  </div>
</div>