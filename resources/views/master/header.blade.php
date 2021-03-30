        
        
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
                    
                    <li class="nav-item nav-active nav-preprocessing">
                        <a class="nav-link" data-toggle="collapse" href="#preprocessing" >
                            <i class="material-icons">plagiarism</i>
                                <p>PreProcessing Data</p>
                        </a>
                        <div class="collapse" id="preprocessing">
                            <ul class="nav">
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
                                    <a href="javascript:void(0)" onclick="HistoryMining()" class="nav-link">
                                        <span>
                                            <i class="material-icons">history</i>
                                        </span>
                                        <span>
                                            Proses Mining
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="IndexHistoryPreprocessing()" class="nav-link">
                                        <span>
                                            <i class="material-icons">history</i>
                                        </span>
                                        <span>
                                            Preprocessing
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="HistoryImprotDatabase()" class="nav-link">
                                        <span>
                                            <i class="material-icons">history</i>
                                        </span>
                                        <span>
                                            History Preprocessing
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-kamus">
                        <a class="nav-link" data-toggle="collapse" href="#kamus">
                            <i class="material-icons">assignment</i>
                                <p>Kamus</p>
                        </a>
                        <div class="collapse" id="kamus">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="PageInputKamus()" class="nav-link">
                                        <span>
                                            <i class="material-icons">add_circle_outline</i>
                                        </span>
                                        <span>
                                            Input Kamus
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-pelabelan">
                        <a class="nav-link" data-toggle="collapse" href="#pelabelan">
                            <i class="material-icons">miscellaneous_services</i>
                                <p>Recognition Process</p>
                        </a>
                        <div class="collapse" id="pelabelan">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="HistoryPelabelan()" class="nav-link">
                                        <span>
                                            <i class="material-icons">add_circle_outline</i>
                                        </span>
                                        <span>
                                            Pelabelan
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-active nav-final-classification">
                        <a class="nav-link" data-toggle="collapse" href="#final-classification">
                            <i class="material-icons">miscellaneous_services</i>
                                <p>Final Classification</p>
                        </a>
                        <div class="collapse" id="final-classification">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" onclick="FinalClassificationIndex()" class="nav-link">
                                        <span>
                                            <i class="material-icons">add_circle_outline</i>
                                        </span>
                                        <span>
                                            Classification
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- your sidebar here -->
                </ul>
            </div>
        </div>