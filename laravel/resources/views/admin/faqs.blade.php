<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQS</title>
</head>
<body>
    <div id="wrapper">
        @include('layouts/app2')
        <div class="content-page">
            <div class="content">

                <!-- Start -->
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Berhasil!</strong>  {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-error alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Gagal!</strong> {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </div>
                    @endif

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <div class="card-header mb-1">
                                    <h2>FAQ</h2>
                                </div>
                                <button type="button" class="btn btn-primary tambah" data-toggle="modal" data-target="faqsModal">
                                    Tambah isi
                                </button>

                                <div class="card-body">
                                    <div id="tabelFAQ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($faqs as $faq)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $faq->pertanyaan }}</td>
                                                        <td>{{ $faq->jawaban }}</td>
                                                        <td>
                                                            <button class="btn btn-warning">Edit</button>
                                                            <button class="btn btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Modal add-->
    <div class="modal fade" id="faqsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="DataFAQ" action="{{ route('faqs') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="PertanyaanFAQ">Pertanyaan</label>
                            <input type="text" class="form-control" parsley-trigger="change" name="pertanyaan_faq" id="PertanyaanFAQ" required>
                        </div>
                        <div class="form-group">
                            <label for="JawabanFAQ">Jawaban</label>
                            <textarea name="jawaban_faq" class="form-control" id="JawabanFAQ" cols="30" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // $('#gambar').dropify();
            // CKEDITOR.replace('#Jawaban');
    
            $(document).on('click','.tambah',function(e){
                $('#faqsModal').modal('show');
            })
        });
    </script>

</body>
</html>