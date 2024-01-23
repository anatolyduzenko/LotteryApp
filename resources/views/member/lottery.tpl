{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
    <h1 class="form-signin-heading py=10">Spin the Fortune wheel!</h1>
    <button class="btn btn-success btn-lg" id="get-my-luck">Get My Luck NOW!</button>
    <div id="lottery-container">
        <div id="spinner">
            <img class="" src="/images/spinner.png" />
        </div>
        <h2>My playing tickets!</h2>
        <table id="results-table" class="w-100">
            <thead>
                <tr>
                    <th>Drawing Date</th>
                    <th>Ticket Number</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$tickets item=ticket}
                    <tr>
                        <td>{$ticket.date_drawing}</td>
                        <td>{$ticket.number}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}
{block name=scripts}
    <script type="text/javascript" >
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#get-my-luck').click(function() {
                $('#spinner').addClass('rotate-center');
                $.ajax({
                    url: '{route('member.getluck')}', // Replace with your server endpoint
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ name: name }),
                    success: function(response) {
                        console.log('Response:', JSON.parse(response));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
            });
            });
        });
    </script>
{/block}