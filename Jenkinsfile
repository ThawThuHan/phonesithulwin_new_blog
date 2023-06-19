pipeline {
  agent any
  stages {
    stage('Git Checkout') {
      steps {
        git(url: 'https://github.com/ThawThuHan/phonesithulwin_new_blog.git', branch: 'main', credentialsId: 'GitHub')
      }
    }

  }
}