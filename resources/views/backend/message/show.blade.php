@extends('backend.layouts.master')
@section('title','KHAYRAT || Détails du Message')
@section('main-content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-envelope-open-text mr-2"></i>Détails du message</h5>
    </div>
    <div class="card-body">
        @if($message)
            <div class="message-meta-grid mb-4">
                <div class="message-author-card">
                    <div class="d-flex align-items-center">
                        <div class="message-avatar-container mr-3">
                            @if($message->photo)
                                <img src="{{$message->photo}}" class="rounded-circle" width="60" height="60">
                            @else 
                                <img src="{{asset('backend/img/avatar.png')}}" class="rounded-circle" width="60" height="60">
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-0">{{$message->name}}</h5>
                            <p class="text-muted mb-0 small">{{$message->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="message-contact-info">
                   <p class="mb-1"><strong><i class="fas fa-phone mr-2"></i>Téléphone :</strong> {{$message->phone}}</p>
                   <p class="mb-0"><strong><i class="fas fa-calendar-alt mr-2"></i>Reçu le :</strong> {{$message->created_at->format('d/m/Y H:i')}}</p>
                </div>
            </div>

            <div class="message-content-wrapper">
                <div class="message-subject-alert mb-4">
                    <strong>Objet :</strong> {{$message->subject}}
                </div>
                <div class="message-body-text p-4 border rounded">
                    {{$message->message}}
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{route('message.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Retour aux messages</a>
            </div>
        @endif
    </div>
</div>

<style>
    .message-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        background: #f8f9fc;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #e3e6f0;
    }

    .message-subject-alert {
        background: #eef2f7;
        padding: 1rem 1.5rem;
        border-left: 4px solid #4e73df;
        border-radius: 4px;
        font-size: 1.1rem;
    }

    .message-body-text {
        background: #fff;
        line-height: 1.6;
        color: #444;
        min-height: 200px;
        white-space: pre-wrap;
    }

    .message-avatar-container img {
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection