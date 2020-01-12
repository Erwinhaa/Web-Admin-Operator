<div class="modal modal-danger fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
                    <form action="/slotoperator/delete" method="post">
                        
                    {{csrf_field()}}
                <div class="modal-body">
                      <p class="text-center">
                          Are you sure you want to delete this?
                      </p>
                        <input type="text" name="bookId" value="">
      
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Yes</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  
                </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('#delete').on('show.bs.modal', function(e) {
        var bookId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find('input[name="bookId"]').val(bookId);
        });
        </script>