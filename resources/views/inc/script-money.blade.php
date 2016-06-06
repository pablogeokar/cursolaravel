<script type="text/javascript" src="{{ asset('js/jquery.maskMoney.js')}}" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
              $("#input_money").maskMoney({showSymbol:true, symbol:"US$ ", decimal:".", thousands:","});
        });
    </script>


