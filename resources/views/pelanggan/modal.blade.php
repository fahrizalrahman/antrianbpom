<!-- The Modal 1-->
<div class="modal" id="myModal1" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 1</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 1-->


<!-- The Modal 2-->
<div class="modal" id="myModal2" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 2</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket_2->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket_2->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 2-->

<!-- The Modal 3-->
<div class="modal" id="myModal3" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 3</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket_3->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket_3->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 3-->

<!-- The Modal 4-->
<div class="modal" id="myModal4" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 4</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket_4->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket_4->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 4-->

<!-- The Modal 5-->
<div class="modal" id="myModal5" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 5</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket_5->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket_5->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 5-->

<!-- The Modal 6-->
<div class="modal" id="myModal6" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">LANTAI 6</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @if($layanan_loket_6->count() > 0)
            <ul class="list-group list-group-flush">
                    @foreach($layanan_loket_6->get() as $value)
                  <li class="list-group-item">{{$value->nama_layanan}}</li>
                    @endforeach
            </ul> 
         @endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 6-->