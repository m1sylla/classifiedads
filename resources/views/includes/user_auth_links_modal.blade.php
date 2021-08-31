<div class="modal" id="authLinksModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Se connecter ou s'inscrire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <a class="px-3 py-1" href="{{ route('login') }}">
                        Se connecter
                    </a>
                    &nbsp;&nbsp; <strong>/</strong> &nbsp;&nbsp;
                    <a class="px-3 py-1" href="{{ route('register') }}">
                        S'inscrire
                    </a>
            </div>
        <div>
    </div>
</div>