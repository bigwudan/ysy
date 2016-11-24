## 简介
20161020 郁生源 开发11
<?xml version="1.0" encoding="UTF-8"?>

<process name="demo" xmlns="http://jbpm.org/4.4/jpdl">
   <start g="369,13,48,48" name="start1">
      <transition g="-52,-22" name="to task1" to="task1"/>
   </start>
   <end g="443,543,48,48" name="end1"/>
   <task candidate-groups="team1,team2" g="364,103,92,52" name="task1">
      <transition g="-56,-22" name="to state1" to="state1"/>
   </task>
   <state g="370,229,92,52" name="state1">
      <transition g="-79,-22" name="to exclusive1" to="exclusive1"/>
   </state>
   <decision g="396,311,48,48" name="exclusive1">
   <handler class="\Org\Jbmp\TestHander\testHander" />
      <transition g="-56,-22" name="to state2" to="state2"/>
      <transition g="-52,-22" name="to task2" to="task2"/>
   </decision>
   <state g="267,373,92,52" name="state2">
      <transition g="-56,-22" name="to state3" to="state3"/>
   </state>
   <task candidate-users="user1" g="503,363,92,52" name="task2">
      <transition g="-56,-22" name="to state3" to="state3"/>
   </task>
   <state g="395,452,92,52" name="state3">
      <transition g="-50,-22" name="to end1" to="end1"/>
   </state>
</process>
域名地址http://localhost/ysy/admin.php/Rbac/Rbac/actionOperationUser
