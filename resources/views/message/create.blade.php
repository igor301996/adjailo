@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">Form</div>
                    <div class="card-body">
                        <h3 class="card-title">Новое сообщение</h3>
                        <form action="{{ route('message.store', $application) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Сообщение</label>
                                <input class="form-control" name="message" type="text">
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-success" type="submit">
                                    Отправить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
