    <div>
      <h3>Paypal Transactions</h3>
      <ul>
      {{foreach $transactions as $transaction}}
      <li><b>{{$transaction.amount}} ({{$transaction.currency}})</b> | {{$transaction.intent}} - {{$transaction.state}} | {{$transaction.timestamp}} | <i>{{$transaction.payer}}</i> </li>
      {{/foreach}}
      </ul>
    </div>
