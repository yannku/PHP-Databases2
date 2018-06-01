


<div class="row justify-content-center title">
                <div class="col-6">
                  <p><?=$course['c_name'];?></p>
                </div>
                <div class="col-sm-4">
                    <img class="corimg" src="Images\3d modelling2.jpg" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                  <p><?=$info['Description'];?></p>
                </div>
            </div>
            <div class="row justify-content-center">
                <table class="col-6 table ">
                    <thead>
                     <tr>
                        <td scope="col">Course Code</td>
                        <td scope="col"><?=$course['c_code'];?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Duration</td>
                        <td><?=$course['c_duration'];?> years</td>
                      </tr>
                      <tr>
                        <td>MQF</td>
                        <td>Level <?=$course['c_mqf'];?></td>
                      </tr>
                     </tbody>
                </table>
             </div>
             <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h4>Requirments</h4>
                    <p><?=str_replace(PHP_EOL,'<br>', $info['Requirments']);?></p>
                    <h4>Study Units</h4>
                    <p><?=str_replace(PHP_EOL,'<br>', $info['Study_units']);?></p>
                    <h4>Carrier opportunities</h4>
                    <p><?=str_replace(PHP_EOL,'<br>', $info['Carrier_opportunities']);?></p>

                </div>
             </div>
