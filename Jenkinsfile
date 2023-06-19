pipeline {
  agent any
  stages {
    stage('Git Checkout') {
      parallel {
        stage('Git Checkout') {
          steps {
            git(url: 'https://github.com/ThawThuHan/phonesithulwin_new_blog.git', branch: 'main', credentialsId: 'GitHub')
          }
        }

        stage('') {
          steps {
            git(url: 'https://github.com/ThawThuHan/phonesithulwin_new_blog.git', branch: 'dev', credentialsId: 'GitHub')
          }
        }

      }
    }

    stage('') {
      steps {
        sh 'ls -la'
      }
    }

  }
}