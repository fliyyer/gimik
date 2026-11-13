#!/usr/bin/env python3
import os
import shutil

# Copy index_temp.html to index.html so seeker has index.html ready on startup
if os.path.exists('template/presentation/index_temp.html'):
    shutil.copyfile('template/presentation/index_temp.html', 'template/presentation/index.html')
