<div>
    
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="selectTab('general_settings')" class="nav-link {{$tab == 'general_settings' ? 'active' : ''}} " data-toggle="tab" href="#general_settings" role="tab" aria-selected="true">General Settings</a>
            </li>
            <li class="nav-item">
                <a wire:click="selectTab('logo_favicon')" class="nav-link {{$tab == 'logo_favicon' ? 'active' : ''}} " data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo & Favicon</a>
            </li>
            
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{$tab == 'general_settings' ? 'show active' : '' }} " id="general_settings" role="tabpanel">
                <div class="pd-20">
                    <form wire:submit='updateSiteInfo()'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Title</b></label>
                                    <input type="text" wire:model='site_title' class="form-control" placeholder="Enter site title">
                                    @error('site_title')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Email</b></label>
                                    <input type="text" wire:model='site_email' class="form-control" placeholder="Enter site email">
                                    @error('site_email')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Phone Number</b></label>
                                    <input type="text" wire:model='site_phone' class="form-control" placeholder="Enter site phone">
                                    @error('site_phone')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Meta Keyword</b><small>(Optional)</small></label>
                                    <input type="text" wire:model='site_meta_keywords' class="form-control" placeholder="Enter site site meta keyword">
                                    @error('site_meta_keywords')
                                        <span class="text-danger ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Site Meta Description</b><small>(optional)</small></label>
                            <textarea class="form-control" name="" id="" cols="4" rows="4" placeholder="type site meta description...."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{$tab == 'logo_favicon' ? 'show active' : ''}}" id="logo_favicon" role="tabpanel">
                <div class="pd-20  ">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Site Logo</h6>
                                <div class="mb-2 mt-1" style="max-width: 200px">
                                    <img wire:ignore class="img-thumbnail"  id="prewiew-sie-logo" src="" alt="">
                                </div>
                                <form action="{{route('admin.update_logo')}}" method="post" enctype="multipart/form-data" id="updateLogoForm">
                                    @csrf
                                    <div class="mb2">
                                        <input type="file" name="site_logo" id="site_logo" class="form-control">
                                        <span class="text-danger ml-1"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change Logo</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
            
        </div>
    </div>

</div>
