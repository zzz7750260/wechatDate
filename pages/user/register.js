// pages/user/register.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },
  /**提交注册数据 */
  formSubmit:function(e){
    if (e.detail.value.username && e.detail.value.password && e.detail.value.re_password){
      if (e.detail.value.password == e.detail.value.re_password){
        wx.request({
          url: 'http://localhost/wechatDate/app/api.php',
          data: {
            parameter: 'login',
            turl: 'userRegister',
            teUserToken: getApp().globalData.userInfo.dev_token,
            username: e.detail.value.username,
            password: e.detail.value.password,
          },
          method: "POST",
          header: {
            'content-type': 'application/x-www-form-urlencoded',
          },
          success: function (res) {
            console.log(res.data);
            if (res.data.status == 4){
              wx.showToast({
                title: '用户名已经存在',
                icon: 'loading',
                duration: 2000
              })                            
            }
            if (res.data.status == 1){
              /**注册成功，返回登陆页 */
              wx.redirectTo({
                url: './login',
              })
            }

          }
        })
      }
      else{
        wx.showToast({
          title: '密码不一致',
          icon: 'loading',
          duration: 2000,
        })
      }
    }
    else{
      wx.showToast({
        title: '注册名或者密码不能为空',
        icon:'loading',
        duration:2000,
      })
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})