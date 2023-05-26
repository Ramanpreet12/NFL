@extends('front.layout.app')
@section('content')
<style>
    .content-info {
    background: #f9f9f9;
    padding: 40px 0;
    background-size: cover!important;
    background-position: top center!important;
    background-repeat: no-repeat!important;
    position: relative;
   padding-bottom:100px;
}

table {
    width: 100%;
    background: #fff;
    border: 1px solid #dedede;
}

table thead tr th {
    padding: 20px;
    border: 1px solid #dedede;
    color: #000;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background: #f9f9f9;
}

table.result-point tr td.number {
    width: 100px;
    position: relative;
}

.text-left {
    text-align: left!important;
}

table tr td {
    padding: 10px 20px;
    border: 1px solid #dedede;
}
table.result-point tr td .fa.fa-caret-up {
    color: green;
}

table.result-point tr td .fa {
    font-size: 20px;
    position: absolute;
    right: 20px;
}

table tr td {
    padding: 10px 40px;
    border: 1px solid #dedede;
}

table tr td img {
    max-width: 32px;
    float: left;
    margin-right: 11px;
    margin-top: 1px;
    border: 1px solid #dedede;
}


</style>
<section class="content-info">

    <div class="container paddings-mini">

        <h1>Standing</h1>
        <br><br>
       <div class="row">
        <div class="mb-5  col-md-3 d-flex justify-content-between align-items-center">
            {{-- <div> <p>Year</p>
            </div> --}}
            <div> <p>Season</p></div>
            <div>
                <select name="" id="" class="form-control" style="width:180px">
                    <option value="">2021</option>
                    <option value="">2022</option>
                    <option value="">2023</option>

                </select>
            </div>

        </div>



          <div class="col-lg-12">


             <table class="table-striped table-responsive table-hover result-point">
                <thead class="point-table-head">
                   <tr>
                    <tr><td colspan="6">GAMEDAY FOOTBALL CONFERENCE BY REGION</td>
                    </tr>
                      <th class="text-left">No</th>
                      <th class="text-left">TEAM</th>
                      <th class="text-center">W</th>
                      <th class="text-center">L</th>
                      <th class="text-center">T</th>
                      <th class="text-center">PTS</th>
                      {{-- <th class="text-center">GS</th>
                      <th class="text-center">GA</th>
                      <th class="text-center">+/-</th>
                      <th class="text-center">PTS</th> --}}
                   </tr>
                </thead>
                <tbody class="text-center">

                   <tr>
                      <td class="text-left number">1 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="http://html.iwthemes.com/sportscup/run/img/clubs-logos/bra.png" alt="Colombia"><span>Colombia</span>
                      </td>
                      <td>38</td>
                      <td>26</td>
                      <td>9</td>


                      <td>87</td>
                   </tr>
                   <tr>
                      <td class="text-left number">2 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/100/000000/brazil.png" alt="Brazil"><span>Brazil</span>
                      </td>
                      <td>38</td>
                      <td>24</td>
                      <td>7</td>
                      <td>79</td>
                   </tr>
                   <tr>
                      <td class="text-left number">3 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/argentina.png" alt="Argentina"><span>Argentina</span>
                      </td>
                      <td>38</td>
                      <td>22</td>
                      <td>9</td>
                      <td>75</td>
                   </tr>
                   <tr>
                      <td class="text-left number">4<i class="fa fa-caret-down" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/japan.png" alt="Japan"><span>Japan</span>
                      </td>
                      <td>38</td>
                      <td>20</td>
                      <td>10</td>
                      <td>70</td>
                   </tr>
                   {{-- <tr>
                      <td class="text-left number">5 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/flag.png" alt="Senegal"><span>Senegal</span>
                      </td>
                      <td>38</td>
                      <td>19</td>
                      <td>7</td>
                      <td>12</td>
                      <td>58</td>
                      <td>53</td>
                      <td>+5</td>
                      <td>64</td>
                   </tr>
                   <tr>
                      <td class="text-left number">6<i class="fa fa-caret-down" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/poland.png" alt="Poland"><span>Poland</span>
                      </td>
                      <td>38</td>
                      <td>18</td>
                      <td>8</td>
                      <td>12</td>
                      <td>52</td>
                      <td>48</td>
                      <td>+4</td>
                      <td>62</td>
                   </tr>
                   <tr>
                      <td class="text-left number">7<i class="fa fa-caret-down" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/russian-federation.png" alt="Russia"><span>Russia</span>
                      </td>
                      <td>38</td>
                      <td>18</td>
                      <td>6</td>
                      <td>14</td>
                      <td>54</td>
                      <td>33</td>
                      <td>+21</td>
                      <td>60</td>
                   </tr>
                   <tr>
                      <td class="text-left number">8<i class="fa fa-caret-up" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/iran.png" alt="Iran"><span>Iran</span>
                      </td>
                      <td>38</td>
                      <td>12</td>
                      <td>11</td>
                      <td>15</td>
                      <td>48</td>
                      <td>50</td>
                      <td>-2</td>
                      <td>47</td>
                   </tr>
                   <tr>
                      <td class="text-left number">9 <i class="fa fa-circle" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/spain.png" alt="Spain"><span>Spain</span>
                      </td>
                      <td>38</td>
                      <td>26</td>
                      <td>9</td>
                      <td>3</td>
                      <td>73</td>
                      <td>32</td>
                      <td>+41</td>
                      <td>87</td>
                   </tr>
                   <tr>
                      <td class="text-left number">10<i class="fa fa-circle" aria-hidden="true"></i></td>
                      <td class="text-left">
                         <img src="https://img.icons8.com/color/48/000000/france.png" alt="France"><span>France</span>
                      </td>
                      <td>38</td>
                      <td>24</td>
                      <td>7</td>
                      <td>7</td>
                      <td>83</td>
                      <td>38</td>
                      <td>+45</td>
                      <td>79</td>
                   </tr> --}}



                </tbody>
             </table>
<br><br>

          </div>
       </div>
    </div>

 </section>
@endsection
