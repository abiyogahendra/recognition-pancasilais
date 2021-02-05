        
        
        <div class="sidebar" data-color="azure" data-background-color="black" data-image="{{asset('investor/img/sidebar-2.jpg')}}">     
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

            Tip 2: you can also add an image using data-image tag
        -->
            <div class="logo center">
                <img width="20%"  src="{{asset('/storage/icon/1.png')}}" alt="">
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    Selamat Datang 
                </a>
            </div>
            <div class="sidebar-wrapper ps-container ps-theme-default">
                <ul class="nav">
                    <li class="nav-item nav-active active nav-laporan">
                        <a class="nav-link" href="">
                            <i class="material-icons">assignment</i>
                                <p>History Recognition</p>
                        </a>
                    </li>
                    <li class="nav-item nav-active nav-mining">
                        <a class="nav-link" data-toggle="collapse" href="#tweet-mining">
                            <i class="material-icons">assignment_ind</i>
                                <p>Minning Data</p>
                        </a>
                        <div class="collapse" id="tweet-mining">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="HistoryMining()" class="nav-link">
                                        <span>
                                            <i class="material-icons">history</i>
                                        </span>
                                        <span>
                                            History Mining
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="PageUsername()" class="nav-link">
                                        <span>
                                            <i class="material-icons">add_circle_outline</i>
                                        </span>
                                        <span>
                                            Input username
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="PageExportDataMining()" class="nav-link">
                                        <span>
                                            <i class="material-icons">save_alt</i>
                                        </span>
                                        <span>
                                            Export Data Mining
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-preprocessing">
                        <a class="nav-link" data-toggle="collapse" href="#preprocessing" >
                            <i class="material-icons">plagiarism</i>
                                <p>PreProcessing Data</p>
                        </a>
                        <div class="collapse" id="preprocessing">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="IndexHistoryPreprocessing()" class="nav-link">
                                        <span>
                                            <i class="material-icons">history</i>
                                        </span>
                                        <span>
                                            History Preprocessing
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="PagePreProcessing()" class="nav-link">
                                        <span>
                                            <i class="material-icons">add_circle_outline</i>
                                        </span>
                                        <span>
                                            Input File Preprocessing
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="IndexProcessPreprocessing()" class="nav-link">
                                        <span>
                                            <i class="material-icons">archive</i>
                                        </span>
                                        <span>
                                            Process File Preprocessing
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-penjualan" >
                        <a class="nav-link" data-toggle="collapse" href="#mining-data">
                            <i class="material-icons">move_to_inbox</i>
                                <p>Convert To DataBase</p>
                        </a>
                        <div class="collapse" id="mining-data">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link">
                                        <span>
                                            Input username
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-penjualan">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="material-icons">miscellaneous_services</i>
                                <p>Recognition Process</p>
                        </a>
                    </li>
                    <!-- your sidebar here -->
                </ul>
            </div>
        </div>